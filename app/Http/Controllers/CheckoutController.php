<?php
namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Order; // Ensure you have this model
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Show Checkout Page
    public function index()
    {
        $user = Auth::user();

        // Fetch cart items for the logged-in user
        $cartItems = Order::with('dish', 'quantity')
            ->where('user_id', $user->id)
            ->where('order_stage', 'in_cart')
            ->get();

        // Calculate subtotal (Original Prices Sum)
        $subtotal = $cartItems->sum(fn($item) => $item->quantity->original_price);

        // Calculate savings (Total Discount Amount)
        $savings = $cartItems->sum(fn($item) => $item->quantity->original_price - $item->quantity->discount_price);

        // Retrieve applied coupon discount from the `orders` table
        $appliedCoupon = $cartItems->firstWhere('applied_coupon_id', '!=', null);
        $discountAmount = $appliedCoupon ? $appliedCoupon->coupon_discount : 0;

        // Calculate grand total (subtract discount)
        $grandTotal = max(0, $cartItems->sum(fn($item) => $item->quantity->discount_price) - $discountAmount);

        // Shipping Cost Logic
        $freeShippingThreshold = 1000;
        $shippingCost = ($grandTotal >= $freeShippingThreshold) ? 0 : 50;

        // Fetch user addresses
        $addresses = UserAddress::where('user_id', $user->id)->get();

        // **Fetch available coupons, excluding used ones from the `coupon_usages` table**
        $usedCoupons = $user->couponUsages()->pluck('coupon_id'); // Get IDs of used coupons
        $availableCoupons = Coupon::where('active', true)
            ->whereDate('expiry_date', '>=', now())
            ->whereNotIn('id', $usedCoupons) // Exclude already used coupons
            ->get();

        return view('user.checkout', compact(
            'cartItems',
            'subtotal',
            'savings',
            'grandTotal',
            'shippingCost',
            'freeShippingThreshold',
            'addresses',
            'availableCoupons',
            'discountAmount',
            'appliedCoupon'
        ));
    }



    // Process Checkout
    public function saveAddress(Request $request)
    {
        $user = auth()->user();
        $order = Order::where('user_id', $user->id)->where('order_stage', 'in_cart')->first();

        if ($request->selected_address) {
            // If user selects an existing address and doesn't change it, just update order
            $order->selected_address = $request->selected_address;
        } else {
            // Save new address
            $address = UserAddress::create([
                'user_id' => $user->id,
                'country' => $request->country,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'phone' => $request->phone,
            ]);

            // Assign new address to order
            $order->selected_address = $address->id;
        }

        $order->save();

        return redirect()->route('shipping.page'); // Redirect to shipping
    }

    // If user keeps the same address, just update selected_address
    public function updateSelectedAddress(Request $request)
    {
        $order = Order::where('user_id', auth()->id())->where('order_stage', 'in_cart')->first();

        if ($order) {
            $order->selected_address = $request->selected_address;
            $order->save();
        }

        return redirect()->route('shipping.page');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['promo_code' => 'required|string']);

        $user = auth()->user();
        $coupon = Coupon::where('code', $request->promo_code)
            ->where('active', true)
            ->whereDate('expiry_date', '>=', now())
            ->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired coupon.']);
        }

        // Check if the user already used this coupon
        $alreadyUsed = $user->couponUsages()->where('coupon_id', $coupon->id)->exists();
        if ($alreadyUsed) {
            return response()->json(['success' => false, 'message' => 'You have already used this coupon.']);
        }

        $cartItems = Order::where('user_id', $user->id)->where('order_stage', 'in_cart')->get();
        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Your cart is empty.']);
        }

        // Calculate cart total
        $cartTotal = $cartItems->sum('total_amount');

        // Check minimum order value
        if ($coupon->minimum_order_value && $cartTotal < $coupon->minimum_order_value) {
            return response()->json(['success' => false, 'message' => 'Cart total is less than the minimum required.']);
        }

        // Calculate Discount (Percentage or Fixed)
        $discount = $coupon->type === 'percentage'
            ? ($cartTotal * ($coupon->value / 100))
            : $coupon->value;

        // Ensure the total doesn't go negative
        $newTotal = max(0, $cartTotal - $discount);

        // Apply discount to each cart item
        foreach ($cartItems as $item) {
            $item->update([
                'applied_coupon_id' => $coupon->id,
                'coupon_discount' => $discount / $cartItems->count(),
            ]);
        }

        // Save coupon usage
        $user->couponUsages()->create(['coupon_id' => $coupon->id]);

        // Return JSON Response
        return response()->json([
            'success' => true,
            'message' => 'Coupon Applied Successfully!',
            'discount' => convertPrice($discount), // Formatted price
            'discount_raw' => $discount, // Numeric price
            'new_total' => convertPrice($newTotal),
            'new_total_raw' => $newTotal
        ]);

    }

    public function shipping()
    {
        return view('user.shipping');
    }



}
