<?php

namespace App\Http\Controllers;

use App\Mail\OrderSuccessMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\OrderPlacedNotification;

class RazorpayController extends Controller
{
    public function initiate(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        // Convert amount to paisa (Razorpay uses smallest currency unit)
        $amount = intval(round($request->amount * 100));

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
                return redirect()->back()->with('error', 'Payment failed. Try again later!');
            }

            $user = Auth::user();
            $orders = Order::where('user_id', $user->id)->where('order_stage', 'in_cart')->get();

            if ($orders->isEmpty()) {
                return redirect()->back()->with('error', 'No orders found.');
            }

            // Update each order
            foreach ($orders as $order) {
                $order->update([
                    'order_stage' => 'confirmed',
                    'payment_state' => 'completed',
                    'razorpay_payment_id' => $paymentId
                ]);
            }

            // Get admin
            $admin = User::where('role', 'admin')->first();

            // Prepare notification data (original order details)
            $orderDetails = [
                'order_ids' => $orders->pluck('id')->toArray(),
                'user_id' => $user->id,
                'user_name' => $user->name, // Default user name (actual user)
                'total_amount' => $orders->sum('total_amount'),
                'payment_id' => $paymentId,
                'payment_method' => 'Razorpay',
                'status' => 'Completed',
                'shipping_address' => ($orders->first())->selected_address ?? 'Not provided',
                'order_date' => now()->toDateTimeString(),
                'order_items' => $orders->map(function ($order) {
                    return [
                        'item_name' => $order->dish->name,
                        'quantity' => $order->quantity->weight
                    ];
                })->toArray(),
            ];
            // dd($orderDetails['shipping_address']);

            // Send notifications
            if ($admin) {
                // Modify user_name only for admin's notification & email
                $adminOrderDetails = $orderDetails;
                $adminOrderDetails['user_name'] = "admin"; // Change only user_name

                Mail::to($admin->email)->queue(new OrderSuccessMail($adminOrderDetails));
                // Notify admin
                $admin->notify(new OrderPlacedNotification($adminOrderDetails));

            }

            // Notify user with the original order details (user_name remains unchanged)
            Mail::to($user->email)->queue(new OrderSuccessMail($orderDetails));

            return redirect()->route('order.confirmation')->with('success', 'Payment Successful! Your order is confirmed.');
        } catch (\Exception $e) {
            Log::error('Payment update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Payment processing failed. Please contact support.');
        }
    }



}

