<?php
namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Reward;
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
        $subtotal = $cartItems->sum(fn($item) => ($item->quantity->original_price ?? 0) * $item->cart_quantity);

        $discountedTotal = $cartItems->sum(fn($item) => ($item->quantity->discount_price ?? 0) * $item->cart_quantity);

        // Calculate savings (Total Discount Amount)
        $savings = $cartItems->sum(fn($item) => ($item->quantity->original_price - $item->quantity->discount_price) * $item->cart_quantity);

        // Retrieve applied coupon discount from the `orders` table
        $appliedCoupon = $cartItems->firstWhere('applied_coupon_id', '!=', null);
        $discountAmount = $cartItems->sum(fn($item) => $item->coupon_discount ?? 0);


        // Calculate grand total (subtract discount)
        $grandTotal = max(0, $cartItems->sum(fn($item) => $item->quantity->discount_price * $item->cart_quantity) - $discountAmount);


        // Fetch reward based on cart total
        $reward = Reward::where('min_cart_value', '<=', $grandTotal)
            ->orderBy('min_cart_value', 'desc') // Get the highest applicable reward
            ->first();

        $rewardMessage = $reward?->reward_message;


        // **Update the reward message in the orders**
        Order::where('user_id', $user->id)
            ->where('order_stage', 'in_cart')
            ->update(['reward_message' => $rewardMessage]);


        // Fetch user addresses
        $addresses = UserAddress::where('user_id', $user->id)->get();


        // Fetch all active and valid coupons
        $usedCoupons = $user->couponUsages()->pluck('coupon_id');
        $availableCoupons = Coupon::where('active', true)
            ->whereDate('expiry_date', '>=', now())
            ->whereNotIn('id', $usedCoupons)
            ->get();

        // Determine the best coupon that gives the highest savings
        $bestCoupon = null;
        $maxSavings = 0;

        foreach ($availableCoupons as $coupon) {
            $potentialSavings = 0;

            if ($coupon->type === 'fixed') {
                $potentialSavings = $coupon->value;
            } elseif ($coupon->type === 'percentage') {
                $potentialSavings = ($grandTotal * $coupon->value) / 100;
            }

            if ($potentialSavings > $maxSavings) {
                $maxSavings = $potentialSavings;
                $bestCoupon = $coupon;
            }
        }

        return view('user.checkout', compact(
            'cartItems',
            'subtotal',
            'discountedTotal',
            'savings',
            'grandTotal',
            'addresses',
            'availableCoupons',
            'bestCoupon',
            'discountAmount',
            'appliedCoupon',
            'rewardMessage' // Send reward message to frontend
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

        // Calculate Subtotal, Discounts, and Grand Total
        $subtotal = (float) $cartItems->sum(fn($item) => (float) $item->quantity->original_price * $item->cart_quantity);
        $discountedtotal = $cartItems->sum(fn($item) => $item->quantity->discount_price * $item->cart_quantity);
        $savings = (float) $cartItems->sum(fn($item) => (float) ($item->quantity->original_price - $item->quantity->discount_price) * $item->cart_quantity);
        $appliedCoupon = $cartItems->firstWhere('applied_coupon_id', '!=', null);
        $discountAmount = (float) $cartItems->sum(fn($item) => $item->coupon_discount ?? 0);
        $grandTotal = max(0, (float) ($discountedtotal - $discountAmount));

        // Fetch user shipping address
        $userAddress = UserAddress::where('user_id', $user->id)->first();
        $country = $userAddress ? $userAddress->country : null;

        // Determine Shipping Zone
        $totalWeight = (float) $cartItems->sum(fn($item) => (float) $item->quantity->weight * $item->cart_quantity);



        // Fetch the best matching weight bracket
        $shippingZone = DB::table('shipping_zones')
            ->where('country', $country)
            ->where('min_weight', '<=', $totalWeight)
            ->orderBy('min_weight', 'desc')
            ->first();

        if ($shippingZone) {
            \Log::info("Shipping Zone Found: Min Weight = {$shippingZone->min_weight}, Max Weight = " . ($shippingZone->max_weight ?? 'NULL'));
            \Log::info("Base Priority Rate: {$shippingZone->priority_rate}, Base Standard Rate: {$shippingZone->standard_rate}");

            $priorityShipping = (float) $shippingZone->priority_rate;
            $standardShipping = (float) $shippingZone->standard_rate;

            // Fetch the rate for exactly 1 kg
            $oneKgRate = DB::table('shipping_zones')
                ->where('country', $country)
                ->where('min_weight', 1) // Get the 1kg price
                ->first();

            if ($oneKgRate) {
                $perKgChargePriority = (float) $oneKgRate->priority_rate;
                $perKgChargeStandard = (float) $oneKgRate->standard_rate;
                \Log::info("Using 1kg Rate: Priority = {$perKgChargePriority}, Standard = {$perKgChargeStandard}");
            } else {
                // Fallback: Use the per kg price from the current shipping zone
                if ($shippingZone->max_weight && $shippingZone->max_weight > $shippingZone->min_weight) {
                    $perKgChargePriority = $shippingZone->priority_rate / ($shippingZone->max_weight - $shippingZone->min_weight);
                    $perKgChargeStandard = $shippingZone->standard_rate / ($shippingZone->max_weight - $shippingZone->min_weight);
                    \Log::info("Calculated Per KG Rate from Bracket: Priority = {$perKgChargePriority}, Standard = {$perKgChargeStandard}");
                } else {
                    // If there's no max weight, assume a fixed rate per kg
                    $perKgChargePriority = $shippingZone->priority_rate;
                    $perKgChargeStandard = $shippingZone->standard_rate;
                    \Log::info("No Max Weight Defined, Using Flat Rate Per KG: Priority = {$perKgChargePriority}, Standard = {$perKgChargeStandard}");
                }
            }

            // Handle excess weight
            $excessWeight = $totalWeight - $shippingZone->min_weight;
            \Log::info("Excess Weight = {$excessWeight} KG");

            if ($excessWeight > 0) {
                \Log::info("Before Excess Charge - Priority: {$priorityShipping}, Standard: {$standardShipping}");

                $priorityShipping += $excessWeight * $perKgChargePriority;
                $standardShipping += $excessWeight * $perKgChargeStandard;

                \Log::info("After Excess Charge - Priority: {$priorityShipping}, Standard: {$standardShipping}");
            }

            \Log::info("====================================================");
            \Log::info("FINAL SHIPPING COSTS");
            \Log::info("Total Weight: " . $totalWeight, );
            \Log::info("Final Priority Rate: " . number_format($priorityShipping, 2));
            \Log::info("Final Standard Rate: " . number_format($standardShipping, 2));
            \Log::info("====================================================");
        }






        // Determine selected shipping method (default to priority shipping)
        $selectedShipping = $cartItems->first()->type_of_shipping ?? 'priority_shipping';
        $shippingCost = ($selectedShipping === 'priority_shipping') ? $priorityShipping : $standardShipping;

        // Distribute shipping cost only if it's priority or standard shipping
        $cartItemCount = $cartItems->count();
        $shippingPerItem = $cartItemCount > 0 ? ($shippingCost / $cartItemCount) : 0;

        // Update shipping_cost for each cart item based on selected shipping method
        foreach ($cartItems as $item) {
            if ($item->type_of_shipping === 'priority_shipping' || $item->type_of_shipping === 'standard_shipping') {
                $item->shipping_cost = $shippingPerItem;
                $item->save();
            }
        }


        return view('user.shipping', compact(
            'cartItems',
            'subtotal',
            'discountedtotal',
            'savings',
            'grandTotal',
            'userAddress',
            'priorityShipping',
            'standardShipping',
            'discountAmount'
        ));
    }



    public function updateShippingMethod(Request $request)
    {
        $user = Auth::user();
        $shippingMethod = $request->shipping_method;
        $shippingCost = (float) $request->shipping_cost; // Receive shipping cost

        // Fetch cart items
        $cartItems = Order::where('user_id', $user->id)
            ->where('order_stage', 'in_cart')
            ->get();

        $cartItemCount = $cartItems->count();
        $shippingPerItem = $cartItemCount > 0 ? ($shippingCost / $cartItemCount) : 0;

        // Update all "in_cart" orders with new shipping method and distributed shipping cost
        foreach ($cartItems as $item) {
            $item->type_of_shipping = $shippingMethod;
            $item->shipping_cost = $shippingPerItem;
            $item->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Shipping method updated successfully!'
        ]);
    }







}
