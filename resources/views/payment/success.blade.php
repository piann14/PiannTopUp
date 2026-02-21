@extends('layouts.app')

@section('title', 'Pembayaran Berhasil! - PiannTopUp')

@push('styles')
<style>
    .success-page {
        min-height: calc(100vh - 70px);
        display: flex;
        align-items: center;
        padding: 3rem 0;
        background: radial-gradient(ellipse 60% 60% at 50% 30%, rgba(67,233,123,0.12) 0%, transparent 60%);
    }

    .success-container {
        max-width: 650px;
        margin: 0 auto;
        text-align: center;
    }

    .success-icon-wrap {
        margin-bottom: 2rem;
        position: relative;
        display: inline-block;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--gradient-green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto;
        box-shadow: 0 0 40px rgba(67,233,123,0.4);
        animation: successPop 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes successPop {
        0% { transform: scale(0); opacity: 0; }
        70% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    .success-rings {
        position: absolute;
        inset: -15px;
        border-radius: 50%;
        border: 2px solid rgba(67,233,123,0.3);
        animation: ringPulse 2s linear infinite;
    }

    .success-rings:nth-child(2) {
        inset: -30px;
        border-color: rgba(67,233,123,0.15);
        animation-delay: 0.5s;
    }

    @keyframes ringPulse {
        0% { transform: scale(0.9); opacity: 1; }
        100% { transform: scale(1.3); opacity: 0; }
    }

    .success-title {
        font-size: 2.2rem;
        font-weight: 900;
        margin-bottom: 0.8rem;
        background: var(--gradient-green);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .success-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .success-card {
        background: var(--dark-card);
        border: 1px solid rgba(67,233,123,0.25);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        text-align: left;
    }

    .scard-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 1.2rem;
        border-bottom: 1px solid var(--dark-border);
        margin-bottom: 1.5rem;
    }

    .scard-game-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        background: var(--dark-card2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    .scard-game-name { font-weight: 800; font-size: 1.1rem; }
    .scard-game-pkg { color: var(--accent); font-size: 0.9rem; margin-top: 2px; font-weight: 600; }

    .scard-rows {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .scard-item {}
    .scard-item-label {
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-bottom: 3px;
    }
    .scard-item-val {
        font-weight: 600;
        font-size: 0.92rem;
        word-break: break-all;
    }

    .success-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .confetti-container {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 9999;
        overflow: hidden;
    }

    .confetti-piece {
        position: absolute;
        top: -20px;
        width: 10px;
        height: 10px;
        border-radius: 2px;
        animation: confettiFall linear forwards;
    }

    @keyframes confettiFall {
        from { transform: translateY(-20px) rotate(0deg); opacity: 1; }
        to { transform: translateY(110vh) rotate(720deg); opacity: 0; }
    }
</style>
@endpush

@section('content')

@php
    $emojis = [
        'mobile-legends' => '⚔️', 'pubg-mobile' => '🎯', 'free-fire' => '🔥',
        'genshin-impact' => '🌟', 'honkai-star-rail' => '🚀', 'valorant' => '💥',
        'roblox' => '🧱', 'league-of-legends' => '🏆', 'arena-of-valor' => '🛡️',
        'minecraft' => '⛏️',
    ];
    $emoji = $emojis[$order->product->game->slug] ?? '🎮';
@endphp

<!-- Confetti -->
<div class="confetti-container" id="confetti"></div>

<section class="success-page">
    <div class="container success-container">

        <!-- Success Icon -->
        <div class="success-icon-wrap">
            <div class="success-rings"></div>
            <div class="success-rings"></div>
            <div class="success-icon">✓</div>
        </div>

        <h1 class="success-title">Top Up Berhasil! 🎉</h1>
        <p class="success-subtitle">
            Selamat! Transaksi kamu berhasil diproses.<br>
            <strong>{{ $order->product->amount }} {{ $order->product->unit }}</strong> telah dikirim ke akun game kamu.
        </p>

        <!-- Detail Card -->
        <div class="success-card">
            <div class="scard-header">
                <div class="scard-game-icon">{{ $emoji }}</div>
                <div>
                    <div class="scard-game-name">{{ $order->product->game->name }}</div>
                    <div class="scard-game-pkg">{{ $order->product->amount }} {{ $order->product->unit }}</div>
                </div>
            </div>

            <div class="scard-rows">
                <div class="scard-item">
                    <div class="scard-item-label"><i class="fas fa-hashtag"></i> No. Pesanan</div>
                    <div class="scard-item-val" style="font-size:0.78rem">{{ $order->order_number }}</div>
                </div>
                <div class="scard-item">
                    <div class="scard-item-label"><i class="fas fa-user"></i> ID Akun</div>
                    <div class="scard-item-val">{{ $order->game_user_id }}</div>
                </div>
                @if($order->game_server)
                <div class="scard-item">
                    <div class="scard-item-label"><i class="fas fa-server"></i> Server</div>
                    <div class="scard-item-val">{{ $order->game_server }}</div>
                </div>
                @endif
                <div class="scard-item">
                    <div class="scard-item-label"><i class="fas fa-credit-card"></i> Metode Bayar</div>
                    <div class="scard-item-val">{{ $order->payment_channel }}</div>
                </div>
                <div class="scard-item">
                    <div class="scard-item-label"><i class="fas fa-money-bill"></i> Total Bayar</div>
                    <div class="scard-item-val" style="color:var(--accent)">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                </div>
                <div class="scard-item">
                    <div class="scard-item-label"><i class="fas fa-calendar"></i> Waktu Transaksi</div>
                    <div class="scard-item-val" style="font-size:0.8rem">{{ $order->completed_at ? $order->completed_at->format('d M Y H:i') : now()->format('d M Y H:i') }}</div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="success-actions">
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-gamepad"></i> Top Up Lagi
            </a>
            <a href="{{ route('order.track') }}?order_number={{ $order->order_number }}" class="btn btn-outline btn-lg">
                <i class="fas fa-receipt"></i> Lihat Pesanan
            </a>
        </div>

        <div style="margin-top:2rem;padding:1rem;background:rgba(108,99,255,0.07);border:1px solid rgba(108,99,255,0.2);border-radius:12px;font-size:0.82rem;color:var(--text-muted);line-height:1.6;">
            <i class="fas fa-envelope" style="color:var(--primary-light)"></i>
            Bukti transaksi telah dikirim ke <strong style="color:white">{{ $order->buyer_email }}</strong>.<br>
            Jika ada pertanyaan, hubungi CS kami via WhatsApp.
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // CONFETTI
    (function launchConfetti() {
        const container = document.getElementById('confetti');
        const colors = ['#6c63ff','#ff6584','#43e97b','#ffd700','#38f9d7','#f093fb'];
        for (let i = 0; i < 80; i++) {
            const piece = document.createElement('div');
            piece.className = 'confetti-piece';
            piece.style.cssText = `
                left: ${Math.random() * 100}%;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                width: ${Math.random() * 12 + 6}px;
                height: ${Math.random() * 12 + 6}px;
                border-radius: ${Math.random() > 0.5 ? '50%' : '2px'};
                animation-duration: ${Math.random() * 3 + 2}s;
                animation-delay: ${Math.random() * 2}s;
            `;
            container.appendChild(piece);
        }
        setTimeout(() => container.remove(), 6000);
    })();

    showToast('🎉 Top Up berhasil! Selamat bermain!', 'success');
</script>
@endpush
