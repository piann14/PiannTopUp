<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Product;
use App\Models\PaymentMethod;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopUpController extends Controller
{
    public function show(Game $game)
    {
        $game->load('activeProducts');
        $paymentMethods = PaymentMethod::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('topup.show', compact('game', 'paymentMethods'));
    }

    public function checkUser(Request $request)
    {
        // Simulasi cek user ID game
        $gameId = $request->game_user_id;
        $server = $request->game_server;

        // Dalam produksi, ini akan menghubungi API game
        if (strlen($gameId) >= 5) {
            return response()->json([
                'success' => true,
                'username' => 'Player#' . strtoupper(substr($gameId, -4)),
                'message' => 'User ditemukan'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User ID tidak ditemukan'
        ]);
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'game_user_id' => 'required|string|min:3',
            'game_server' => 'nullable|string',
            'buyer_name' => 'required|string|min:2',
            'buyer_email' => 'required|email',
            'buyer_phone' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::with('game')->findOrFail($request->product_id);
        $paymentMethod = PaymentMethod::where('code', $request->payment_method)->first();

        $adminFee = $paymentMethod ? $paymentMethod->calculateFee($product->price) : 0;
        $totalAmount = $product->price + $adminFee;

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'product_id' => $product->id,
            'game_user_id' => $request->game_user_id,
            'game_server' => $request->game_server,
            'game_username' => $request->game_username,
            'buyer_name' => $request->buyer_name,
            'buyer_email' => $request->buyer_email,
            'buyer_phone' => $request->buyer_phone,
            'amount' => $product->price,
            'admin_fee' => $adminFee,
            'total_amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'payment_channel' => $paymentMethod ? $paymentMethod->name : $request->payment_method,
            'status' => 'pending',
            'payment_token' => md5(uniqid()),
        ]);

        return response()->json([
            'success' => true,
            'order_number' => $order->order_number,
            'redirect' => route('payment.show', $order->order_number)
        ]);
    }
}
