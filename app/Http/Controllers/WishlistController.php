<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishlistItem;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    //
    public function store(Request $request)
    {
        try {
            $user = auth()->user();

            // Check if the item already exists in the wishlist
            $existingItem = WishlistItem::where('user_id', $user->id)
                ->where('dish_id', $request->dish_id)
                ->where('quantity_id', $request->quantity_id)
                ->first();

            if ($existingItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item already exists in your wishlist.',
                ], 409); // HTTP 409 Conflict
            }

            // Create a new wishlist entry
            $wishlistItem = WishlistItem::create([
                'dish_id' => $request->dish_id,
                'user_id' => $user->id,
                'quantity_id' => $request->quantity_id,
                'total_amount' => $request->total_amount,
                'cart_quantity' => 1,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Item added to wishlist successfully!',
                'wishlistItem' => $wishlistItem
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add item to wishlist. Please try again later.',
            ], 500);
        }
    }



    public function getWishlistItems()
    {
        $userId = Auth::id(); // Get the logged-in user's ID

        $wishlistItems = WishlistItem::where('user_id', $userId)
            ->with(['dish', 'quantity']) // Eager load relationships
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'dish_id' => optional($item->dish)->id, // Use `optional` to handle null
                    'dish_name' => optional($item->dish)->name,
                    'quantity_id' => optional($item->quantity)->id,
                    'quantity' => optional($item->quantity)->quantity,
                    'price' => optional($item->quantity)->price, // Assuming `price` is in the `dishes` table
                ];
            });

        return response()->json(['items' => $wishlistItems]);
    }

    public function destroy($id)
    {
        $wishlistItem = WishlistItem::find($id);

        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->back()->with('success', 'Item removed from wishlist successfully');
        }

        return redirect()->back()->with('error', `No Item Found`);
    }

}
