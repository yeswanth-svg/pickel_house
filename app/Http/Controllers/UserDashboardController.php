<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Referral;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //

    public function referrals()
    {
        $referrals = Referral::where('referrer_id', auth()->id())->with('referredUser')->get();

        return view('user.referrals', compact('referrals'));
    }

    public function order_history()
    {
        $user_id = auth()->user()->id;

        $orders = Order::where('user_id', $user_id)
            ->where('order_stage', '!=', 'in_cart')
            ->where('order_stage', '!=', 'removed_from_cart') // Exclude 'in_cart' orders
            ->get();

        return view('user.order_history', compact('orders'));
    }

    public function cancelOrder(Request $request, Order $order)
    {
        // Ensure the order can still be cancelled
        if ($order->order_stage === 'shipped' || $order->order_stage === 'out_for_delivery') {
            return response()->json([
                'success' => false,
                'message' => 'Order cannot be canceled as it has already been shipped.'
            ]);
        }

        // Save the cancellation reason and mark order as cancelled
        $order->update([
            'order_stage' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Order has been cancelled successfully.'
        ]);
    }


}
