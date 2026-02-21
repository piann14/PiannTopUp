<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['product.game'])
            ->firstOrFail();

        return view('payment.show', compact('order'));
    }

    public function callback(Request $request)
    {
        // Callback dari payment gateway
        $orderNumber = $request->order_id ?? $request->external_id;
        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $status = $request->status ?? $request->payment_status;

        if (in_array(strtolower($status), ['paid', 'settled', 'completed', 'success'])) {
            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
                'payment_data' => $request->all(),
            ]);

            // Proses topup (dalam produksi, call API game)
            $order->update(['status' => 'processing']);

            // Simulasi sukses
            $order->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);
        }
        elseif (in_array(strtolower($status), ['failed', 'failure', 'expired'])) {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'OK']);
    }

    public function simulatePay($orderNumber)
    {
        // Hanya untuk demo - simulasi pembayaran berhasil
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        if ($order->status === 'pending') {
            $order->update([
                'status' => 'completed',
                'paid_at' => now(),
                'completed_at' => now(),
            ]);
        }

        return redirect()->route('payment.success', $orderNumber);
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['product.game'])
            ->firstOrFail();

        return view('payment.success', compact('order'));
    }

    public function checkStatus($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        return response()->json([
            'status' => $order->status,
            'paid_at' => $order->paid_at,
        ]);
    }
}
