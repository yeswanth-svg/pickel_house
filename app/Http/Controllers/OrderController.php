<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Dish;
use App\Models\DishQuantity;
use App\Models\Order;
use App\Models\Setting;
use App\Models\UserAddress;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use App\Models\Reward;

class OrderController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'wishlist_id' => 'nullable|integer',
            'dish_id' => 'required|integer',
            'quantity_id' => 'required|integer',
            'cart_quantity' => 'required|integer|min:1', // Renamed quantity to cart_quantity
        ]);

        $wishlist_id = $validatedData['wishlist_id'] ?? null;
        if ($wishlist_id) {
            $wishlist_item = WishlistItem::find($wishlist_id);
            if ($wishlist_item) {
                $wishlist_item->delete();
            }
        }

        $user_id = auth()->user()->id;

        // Fetch dish quantity details
        $quantityDetails = DishQuantity::find($validatedData['quantity_id']);
        if (!$quantityDetails) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid dish quantity selection.',
            ], 400);
        }

        // Assign prices from dish quantity table
        $originalPrice = $quantityDetails->original_price;
        $discountPrice = $quantityDetails->discount_price; // The selling price
        $itemTotalAmount = $discountPrice * $validatedData['cart_quantity']; // Calculate total for item

        // Check if the same dish with the same quantity_id exists in the cart
        $cartItem = Order::where('user_id', $user_id)
            ->where('dish_id', $validatedData['dish_id'])
            ->where('quantity_id', $validatedData['quantity_id'])
            ->where('order_stage', 'in_cart')
            ->first();

        if ($cartItem) {
            // If item exists, update the cart_quantity and total_amount
            $cartItem->cart_quantity += $validatedData['cart_quantity'];
            $cartItem->total_amount += $itemTotalAmount;
            $cartItem->updated_at = now();
            $cartItem->save();
        } else {
            // If no existing cart item, create a new one
            Order::create([
                'user_id' => $user_id,
                'dish_id' => $validatedData['dish_id'],
                'quantity_id' => $validatedData['quantity_id'],
                'cart_quantity' => $validatedData['cart_quantity'],
                'original_price' => $originalPrice, // Save the original price
                'discount_price' => $discountPrice, // Save the admin-set price
                'total_amount' => $itemTotalAmount, // Total based on discount_price
                'order_stage' => 'in_cart',
                'spice_level' => $request->spice_level ?: 'mild',
            ]);
        }

        // Recalculate the cart total
        $cartTotal = Order::where('user_id', $user_id)
            ->where('order_stage', 'in_cart')
            ->sum('total_amount');

        // Apply coupon discount if available
        $couponDiscount = session('coupon_discount', 0);
        $newTotal = ($couponDiscount > 0) ? max($cartTotal - $couponDiscount, 0) : $cartTotal;
        session(['new_total' => $newTotal]);

        return response()->json([
            'success' => true,
            'message' => 'Item added to Cart successfully!',
        ]);
    }



    public function viewCart()
    {
        $user = auth()->user();
        $user_id = $user->id;

        // Retrieve cart items
        $cartItems = Order::where('user_id', $user_id)
            ->where('order_stage', 'in_cart')
            ->with(['dish', 'quantity'])
            ->get();

        // Calculate Totals
        $cartTotal = $cartItems->sum(fn($item) => ($item->quantity->original_price ?? 0) * $item->cart_quantity);
        $discountTotal = $cartItems->sum(fn($item) => (($item->quantity->original_price ?? 0) - ($item->quantity->discount_price ?? 0)) * $item->cart_quantity);
        $finalTotal = $cartItems->sum(fn($item) => ($item->quantity->discount_price ?? 0) * $item->cart_quantity);

        $totalWeight = $cartItems->sum(function ($item) {
            // Extract weight and convert to grams
            $weight = $item->quantity->weight;

            // Check for 'g' (grams) or 'kg' (kilograms) format
            preg_match('/(\d+)\s*(g|kg)/', $weight, $matches);

            // Initialize the item weight in grams
            $itemWeightInGrams = 0;

            if (isset($matches[1])) {
                // If it's in grams
                if ($matches[2] == 'g') {
                    $itemWeightInGrams = $matches[1]; // Extracted weight in grams
                }
                // If it's in kilograms, convert to grams
                elseif ($matches[2] == 'kg') {
                    $itemWeightInGrams = $matches[1] * 1000; // Convert kg to grams
                }
            }

            // Multiply by cart quantity to get the total weight for this item
            $itemTotalWeight = $itemWeightInGrams * $item->cart_quantity;

            // Debug: Output item weight and total weight for each cart item
            \Log::info("Item weight: $itemWeightInGrams, Cart quantity: {$item->cart_quantity}, Total weight for this item: $itemTotalWeight");

            return $itemTotalWeight;
        });

        // Debugging total weight calculation
        \Log::info("Total weight: $totalWeight");





        // Fetch the minimum order weight from the settings table
        $minimumOrderWeightSetting = Setting::where('key', 'minimun_order_weight')->first();
        $minimumOrderWeight = isset($minimumOrderWeightSetting) ? (int) preg_replace('/\D/', '', $minimumOrderWeightSetting->value) : 0;

        // If the minimum order weight is in kg, convert it to grams
        if (strpos($minimumOrderWeightSetting->value, 'kg') !== false) {
            $minimumOrderWeight *= 1000;  // Convert kg to grams
        }

 

        // Fetch the warning message from the settings table
        $warningMessageSetting = Setting::where('key', 'minimun_order_weight')->first();
        $weight = Setting::where('key', 'minimun_order_weight')->first();
        $weight = $weight ? $weight->value : '0g'; // Default weight in grams
        $warningMessage = $warningMessageSetting ? $warningMessageSetting->content : 'Your cart does not meet the minimum weight requirement.';

        // Check if the cart weight meets the minimum order weight
        $isWeightValid = $totalWeight >= $minimumOrderWeight;

        // Fetch rewards dynamically
        $rewards = Reward::orderBy('min_cart_value', 'asc')->get();

        // Find the highest eligible reward
        $eligibleReward = null;
        foreach ($rewards as $reward) {
            if ($finalTotal >= $reward->min_cart_value) {
                $eligibleReward = $reward;
            }
        }

        // Find the next reward threshold
        $nextThreshold = null;
        foreach ($rewards as $reward) {
            if ($finalTotal < $reward->min_cart_value) {
                $nextThreshold = $reward;
                break;
            }
        }
        $remainingForNextReward = $nextThreshold ? max(0, $nextThreshold->min_cart_value - $finalTotal) : null;

        return view('user.cart', compact(
            'cartItems',
            'cartTotal',
            'discountTotal',
            'finalTotal',
            'eligibleReward',
            'nextThreshold',
            'remainingForNextReward',
            'totalWeight',
            'minimumOrderWeight',
            'weight',
            'isWeightValid',
            'warningMessage' // Pass the warning message to the view
        ));
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
            ->where('order_stage', 'in_cart')
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





    public function order_confirmation()
    {
        return view('user.order-confirmation');
    }

    public function destroy($id)
    {
        // Find the order item by ID
        $order = Order::findOrFail($id);

        // Ensure the item belongs to the current user (optional for security)
        if ($order->user_id !== auth()->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        if ($order && $order->order_stage === 'in_cart') {
            $order->order_stage = 'removed_from_cart';
            $order->applied_coupon_id = 0;
            $order->coupon_discount = 0;

        }
        // Delete the item
        $order->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Item removed from your cart!');
    }
}
