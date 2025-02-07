<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Dish;
use App\Models\Order;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'dish_id' => 'required|integer',
            'quantity_id' => 'required|integer',
            'total_amount' => 'required',
        ]);

        $user_id = auth()->user()->id;

        // Check if the cart already has the same dish with the same ingredients
        $cart = Order::where('user_id', $user_id)
            ->where('dish_id', $validatedData['dish_id'])
            ->where('quantity_id', $validatedData['quantity_id'])  // Compare based on ingredients
            ->where('status', 'Cart')
            ->first();

        if ($cart) {
            // If the cart item already exists, update it
            $cart->total_amount = $validatedData['total_amount'];  // Update total_amount if necessary
            $cart->updated_at = now();
            $cart->save();
        } else {
            // If no cart item exists, create a new one
            Order::create([
                'user_id' => $user_id,
                'dish_id' => $validatedData['dish_id'],
                'quantity_id' => $validatedData['quantity_id'],
                'total_amount' => $validatedData['total_amount'],
                'status' => 'Cart',
            ]);
        }

        // Recalculate the cart total after adding the new dish
        $cartItems = Order::where('user_id', $user_id)
            ->where('status', 'Cart')
            ->get();

        $cartTotal = $cartItems->sum('total_amount');  // Calculate the new cart total

        // Check if a coupon discount is applied and recalculate the new total
        $couponDiscount = session('coupon_discount', 0);
        if ($couponDiscount > 0) {
            // Apply the coupon discount to the new total
            $newTotal = $cartTotal - $couponDiscount;
            session(['new_total' => $newTotal]);  // Update the session with the new total
        } else {
            // If no coupon is applied, just store the new total
            session(['new_total' => $cartTotal]);
        }

        return redirect()->route('home')->with('success', 'Item added to cart!');
    }

    public function viewCart()
    {
        $user = auth()->user();
        $user_id = $user->id;

        $cartItems = Order::where('user_id', $user_id)
            ->where('status', 'Cart')
            ->with(['dish', 'quantity'])
            ->get();

        $cartTotal = $cartItems->sum('total_amount');
        $discountTotal = $cartItems->sum('discount_amount');
        $finalTotal = $cartTotal - $discountTotal;

        $addresses = UserAddress::where('user_id', $user_id)->get();

        // Fetch used and unused coupons logic remains the same
        $usedCouponIds = CouponUsage::where('user_id', $user_id)->pluck('coupon_id')->toArray();
        $allCoupons = Coupon::where('active', true)
            ->whereDate('expiry_date', '>=', now())
            ->where(function ($query) use ($cartTotal) {
                $query->whereNull('minimum_order_value')
                    ->orWhere('minimum_order_value', '<=', $cartTotal);
            })
            ->get();
        $usedCoupons = $allCoupons->whereIn('id', $usedCouponIds);
        $unusedCoupons = $allCoupons->whereNotIn('id', $usedCouponIds);

        return view('cart', [
            'cartItems' => $cartItems,
            'addresses' => $addresses,
            'usedCoupons' => $usedCoupons,
            'unusedCoupons' => $unusedCoupons,
            'cartTotal' => $cartTotal,
            'discountTotal' => $discountTotal,
            'finalTotal' => $finalTotal,
        ]);
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

        $alreadyUsed = $user->couponUsages()->where('coupon_id', $coupon->id)->exists();

        if ($alreadyUsed) {
            return response()->json(['success' => false, 'message' => 'You have already used this coupon.']);
        }

        $cartItems = Order::where('user_id', $user->id)
            ->where('status', 'Cart')
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Your cart is empty.']);
        }

        $cartTotal = $cartItems->sum('total_amount');
        \Log::info("Cart Total =$cartTotal");

        if ($coupon->minimum_order_value && $cartTotal < $coupon->minimum_order_value) {
            return response()->json(['success' => false, 'message' => 'Cart total is less than the minimum required.']);
        }

        $discount = $coupon->type === 'percentage'
            ? ($cartTotal * ($coupon->value / 100))
            : $coupon->value;

        $newTotal = max(0, $cartTotal - $discount);

        // Update orders with coupon and discount
        foreach ($cartItems as $item) {
            \Log::info('Updating Order ID: ' . $item->id, [
                'applied_coupon_id' => $coupon->id,
                'discount_amount' => $discount / $cartItems->count(),
            ]);

            $item->update([
                'applied_coupon_id' => $coupon->id,
                'discount_amount' => $discount / $cartItems->count(),
            ]);
        }



        // Save coupon usage
        $user->couponUsages()->create(['coupon_id' => $coupon->id]);

        return response()->json([
            'success' => true,
            'discount' => $discount,
            'new_total' => $newTotal,
        ]);
    }






    public function checkout(Request $request)
    {
        $request->validate([
            "payment_method" => "required",
            'total_amount' => "required",
        ]);

        $user = auth()->user();
        $orderIds = explode(',', $request->input('order_ids'));
        $paymentMethod = $request->input('payment_method');
        $totalAmountInput = $request->input('total_amount');
        $totalAmount = intval(round((float) str_replace(',', '', $totalAmountInput) * 100));
        $selected_address = session('selected_address') ?? $user->addresses()->where('is_default', 1)->first();

        if (!$selected_address) {
            return redirect()->back()->withErrors('No default address available.');
        }

        if ($paymentMethod === 'COD') {
            // Update orders
            Order::whereIn('id', $orderIds)->where('user_id', $user->id)->update([
                'status' => 'Completed',
                'payment_status' => 'COD',
                'selected_address' => json_encode($selected_address),
            ]);

            // Notify the admin
            // $admin = Admin::first(); // Assuming a single admin user
            // if ($admin) {
            //     $orderDetails = [
            //         'user_id' => $user->id,
            //         'order_ids' => $orderIds,
            //         'payment_method' => $paymentMethod,
            //         'total_amount' => $totalAmount / 100,
            //         'selected_address' => $selected_address,
            //         'status' => 'Completed',
            //     ];
            //     $admin->notify(new OrderPlacedNotification($orderDetails));
            // }

            return redirect()->route('order-confirmation')->with('success', 'Order placed successfully.');
        }


    }

    public function order_confirmation()
    {
        return view('order-confirmation');
    }



    public function destroy($id)
    {
        // Find the order item by ID
        $order = Order::findOrFail($id);

        // Ensure the item belongs to the current user (optional for security)
        if ($order->user_id !== auth('user')->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $order->status = "Cancelled";

        // Delete the item
        $order->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Item removed from your cart!');
    }
}
