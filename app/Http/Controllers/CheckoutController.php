<?php
namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Setting;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Models\Order; // Ensure you have this model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // Get Free Shipping Threshold from `settings` table and convert to float
        $freeShippingThreshold = (float) Setting::where('key', 'free_shipping_threshold')->value('value');
        $shippingCost = ($grandTotal >= $freeShippingThreshold) ? 0 : (float) Setting::where('key', 'shipping_fee')->value('value');

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
        $orders = Order::where('user_id', $user->id)->where('order_stage', 'in_cart')->get();

        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'No active orders found.');
        }

        $addressData = [];

        if ($request->has('selected_address') && !empty($request->selected_address) && $request->selected_address !== "new") {
            // User selected an existing address, update it with new form values
            $address = UserAddress::find($request->selected_address);

            if ($address) {
                $address->update([
                    'country' => $request->country,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'company' => $request->company ?: null,
                    'address' => $request->address,
                    'apartment' => $request->apartment,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip_code' => $request->zip_code,
                    'phone' => $request->phone,
                ]);

                $addressData = $address->toArray();
            }
        } else {
            // User entered a new address, save it
            $address = UserAddress::create([
                'user_id' => $user->id,
                'country' => $request->country,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company' => $request->company ?: null,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'phone' => $request->phone,
            ]);

            $addressData = $address->toArray();
        }

        // Convert address data to JSON
        $addressJson = json_encode($addressData, JSON_PRETTY_PRINT);

        // Update all `in_cart` orders for the user with the new address JSON
        foreach ($orders as $order) {
            $order->update([
                'selected_address' => $addressJson,
                'type_of_shipping' => 'priority_shipping'
            ]);
        }

        return redirect()->route('shipping.page')->with('success', 'Shipping address updated successfully.');
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
        $user = Auth::user();

        // Fetch cart items for the logged-in user
        $cartItems = Order::with('dish', 'quantity')
            ->where('user_id', $user->id)
            ->where('order_stage', 'in_cart')
            ->get();

        // Shipping calculations (same logic as before)
        $subtotal = (float) $cartItems->sum(fn($item) => (float) $item->quantity->original_price);
        $savings = (float) $cartItems->sum(fn($item) => (float) ($item->quantity->original_price - $item->quantity->discount_price));
        $appliedCoupon = $cartItems->firstWhere('applied_coupon_id', '!=', null);
        $discountAmount = (float) ($appliedCoupon ? $appliedCoupon->coupon_discount : 0);
        $grandTotal = max(0, (float) ($cartItems->sum(fn($item) => (float) $item->quantity->discount_price) - $discountAmount));

        // Fetch user shipping address
        $userAddress = UserAddress::where('user_id', $user->id)->first();
        $country = $userAddress ? $userAddress->country : null;

        // Free Shipping Threshold
        $freeShippingThreshold = (float) Setting::where('key', 'free_shipping_threshold')->value('value') ?? 1000;

        if ($grandTotal >= $freeShippingThreshold) {
            $priorityShipping = 0;
            $standardShipping = 0;
        } else {
            $totalWeight = (float) $cartItems->sum(fn($item) => (float) $item->quantity->weight);

            $shippingZone = DB::table('shipping_zones')
                ->where('country', $country)
                ->where('min_weight', '<=', $totalWeight)
                ->where(function ($query) use ($totalWeight) {
                    $query->where('max_weight', '>=', $totalWeight)
                        ->orWhereNull('max_weight');
                })
                ->orderBy('max_weight', 'asc')
                ->first();

            $priorityShipping = $shippingZone ? $shippingZone->priority_rate : 50;
            $standardShipping = $shippingZone ? $shippingZone->standard_rate : 50;
        }

        // **Fetch available coupons, excluding used ones from the `coupon_usages` table**
        $usedCoupons = $user->couponUsages()->pluck('coupon_id'); // Get IDs of used coupons
        $availableCoupons = Coupon::where('active', true)
            ->whereDate('expiry_date', '>=', now())
            ->whereNotIn('id', $usedCoupons) // Exclude already used coupons
            ->get();

        return view('user.shipping', compact(
            'cartItems',
            'subtotal',
            'savings',
            'grandTotal',
            'userAddress',
            'priorityShipping',
            'standardShipping',
            'discountAmount',
            'appliedCoupon',
            'availableCoupons',
        ));
    }


    public function updateShippingMethod(Request $request)
    {
        $user = Auth::user();
        $shippingMethod = $request->shipping_method;

        // Update all "in_cart" orders with new shipping method
        Order::where('user_id', $user->id)
            ->where('order_stage', 'in_cart')
            ->update(['type_of_shipping' => $shippingMethod]);

        return response()->json(['success' => true, 'message' => 'Shipping method updated successfully!']);
    }






}
