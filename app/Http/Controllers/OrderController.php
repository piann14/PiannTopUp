<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function track(Request $request)
    {
        $order = null;
        $error = null;

        if ($request->has('order_number')) {
            $order = Order::where('order_number', $request->order_number)
                ->with(['product.game'])
                ->first();

            if (!$order) {
                $error = 'Order tidak ditemukan. Periksa kembali nomor pesanan Anda.';
            }
        }

        return view('order.track', compact('order', 'error'));
    }
}
