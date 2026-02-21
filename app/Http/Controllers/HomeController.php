<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredGames = Game::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $allGames = Game::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $mobileGames = Game::where('is_active', true)
            ->where('category', 'mobile')
            ->orderBy('sort_order')
            ->get();

        $pcGames = Game::where('is_active', true)
            ->where('category', 'pc')
            ->orderBy('sort_order')
            ->get();

        $totalOrders = Order::where('status', 'completed')->count();

        return view('home', compact('featuredGames', 'allGames', 'mobileGames', 'pcGames', 'totalOrders'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $games = Game::where('is_active', true)
            ->where('name', 'like', "%$query%")
            ->get();

        return response()->json($games);
    }
}
