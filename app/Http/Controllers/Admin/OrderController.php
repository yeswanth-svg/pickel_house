<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(string $id)
    {
        $order = Order::find($id);
        return view('admin.orders.show', compact('order'));
    }

    public function destroy(string $id)
    {
        //
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    public function confirmed()
    {
        $orders = Order::where('order_stage', 'confirmed')->get();
        return view('admin.orders.confirmed', compact('orders'));
    }

    public function processing()
    {
        $orders = Order::where('order_stage', 'processing')->get();
        return view('admin.orders.processing', compact('orders'));
    }

    public function packing()
    {
        $orders = Order::where('order_stage', 'packing')->get();
        return view('admin.orders.packing', compact('orders'));
    }


    public function shipped()
    {
        $orders = Order::where('order_stage', 'shipped')->get();
        return view('admin.orders.shipped', compact('orders'));
    }

    public function completed()
    {
        $orders = Order::where('order_stage', 'completed')->get();
        return view('admin.orders.completed', compact('orders'));
    }

    public function cancelled()
    {
        $orders = Order::where('order_stage', 'cancelled')->get();
        return view('admin.orders.cancelled', compact('orders'));
    }

    public function returned()
    {
        $orders = Order::where('order_stage', 'returned')->get();
        return view('admin.orders.returned', compact('orders'));
    }

    public function paymentPending()
    {
        $orders = Order::where('payment_state', 'pending')->get();
        return view('admin.orders.payments.pending', compact('orders'));
    }



    public function paymentFailed()
    {
        $orders = Order::where('payment_state', 'failed')->get();
        return view('admin.orders.payments.failed', compact('orders'));
    }

    public function paymentProcessing()
    {
        $orders = Order::where('payment_state', 'processing')->get();
        return view('admin.orders.payments.processing', compact('orders'));
    }


    public function paymentCompleted()
    {
        $orders = Order::where('payment_state', 'paid')->get();
        return view('admin.orders.payments.completed', compact('orders'));
    }

    public function paymentRefunded()
    {
        $orders = Order::where('payment_state', 'refunded')->get();
        return view('admin.orders.payments.refunded', compact('orders'));
    }


    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'order_stage' => 'required|in:in_cart,confirmed,processing,packing,shipped,out_for_delivery,delivered,completed,cancelled,returned,removed_from_cart',
        ]);

        $order->order_stage = $request->order_stage;
        $order->save();

        return back()->with('success', 'Order status updated successfully.');
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'payment_state' => 'required|in:pending,processing,failed,completed,refunded,partially_refunded,chargeback',
        ]);

        $order->payment_state = $request->payment_state;
        $order->save();

        return back()->with('success', 'Payment status updated successfully.');
    }

}
