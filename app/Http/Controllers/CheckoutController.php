<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Ensure you have this model
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Show Checkout Page
    public function index()
    {
        // Fetch cart items for the logged-in user
        $cartItems = order::with('dish', 'quantity')->where('user_id', Auth::id())->get();

        // Calculate subtotal
        $subtotal = $cartItems->sum(fn($item) => $item->quantity->price);

        // Shipping (For now, leave it empty; you can calculate it later)
        $shipping = "Calculated at next step";  

        // Total (If shipping is a fixed cost, add it here later)
        $total = $subtotal; 

        return view('checkout', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }
    // Process Checkout
    public function processCheckout(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'phone' => 'required|string',
        ]);

        // Store order in database (example)
        // Order::create($validated);

        return redirect()->route('checkout')->with('success', 'Order placed successfully!');
    }
}
