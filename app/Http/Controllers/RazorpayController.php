<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RazorpayController extends Controller
{
    public function initiate(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Convert amount to paisa (Razorpay uses smallest currency unit)
        $amount = $request->amount * 100;
        $currency = $request->currency;

        $order = $api->order->create([
            'receipt' => 'order_' . time(),
            'amount' => $amount,
            'currency' => $currency,
            'payment_capture' => 1 // Auto capture
        ]);

        return response()->json([
            'key' => env('RAZORPAY_KEY'),
            'amount' => $amount,
            'currency' => $currency,
            'order_id' => $order['id'],
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
    }

    public function success(Request $request)
    {
        try {
            $paymentId = $request->query('payment_id');

            if (!$paymentId) {
                return redirect()->back()->with('error', 'Payment is failed Try Again Later!');
            }

            $user = Auth::user();

            // Update orders for the logged-in user where status is 'cart'
            Order::where('user_id', $user->id)
                ->where('order_stage', 'in_cart')
                ->update([
                    'order_stage' => 'confirmed',
                    'payment_state' => 'completed',
                    'razorpay_payment_id' => $paymentId
                ]);
            return redirect()->route('order.confirmation')->with('success', 'Payment Successful! Your order is confirmed.');

        } catch (\Exception $e) {
            Log::error('Payment update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Payment processing failed. Please contact support.');
        }
    }
}

