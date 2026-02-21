@extends('layouts.app')

@section('title', 'Cek Pesanan - PiannTopUp')

@push('styles')
<style>
    .track-page {
        min-height: calc(100vh - 70px);
        padding: 4rem 0;
        background: radial-gradient(ellipse 60% 40% at 50% 20%, rgba(108,99,255,0.1) 0%, transparent 60%);
    }

    .track-container {
        max-width: 700px;
        margin: 0 auto;
    }

    .track-search-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 20px;
        padding: 2.5rem;
        margin-bottom: 2rem;
    }

    .track-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: rgba(108,99,255,0.1);
        border: 1px solid rgba(108,99,255,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .track-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .track-subtitle {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }

    .track-form {
        display: flex;
        gap: 1rem;
    }

    .track-form .form-control {
        flex: 1;
        background: var(--dark-card2);
        border: 1px solid var(--dark-border);
        border-radius: 12px;
        padding: 13px 16px;
        color: white;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: all 0.3s ease;
    }

    .track-form .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.15);
    }

    .track-form .form-control::placeholder { color: var(--text-muted); }

    /* Result card */
    .result-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 20px;
        overflow: hidden;
    }

    .result-card-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--dark-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .rch-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .rch-icon {
        font-size: 2rem;
    }

    .rch-title { font-weight: 700; font-size: 1rem; }
    .rch-order { font-size: 0.8rem; color: var(--text-muted); }

    .result-card-body {
        padding: 1.5rem 2rem;
    }

    .result-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 0.7rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        font-size: 0.88rem;
        gap: 1rem;
    }

    .result-row:last-child { border-bottom: none; }

    .rr-label { color: var(--text-muted); flex-shrink: 0; }
    .rr-val { font-weight: 600; text-align: right; }

    /* Timeline */
    .timeline {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--dark-border);
    }

    .timeline-title {
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin-bottom: 1.2rem;
    }

    .timeline-item {
        display: flex;
        gap: 14px;
        margin-bottom: 1.2rem;
    }

    .timeline-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: var(--dark-border);
        border: 2px solid var(--dark-border);
        flex-shrink: 0;
        margin-top: 3px;
        position: relative;
    }

    .timeline-dot.active {
        background: var(--primary);
        border-color: var(--primary);
        box-shadow: 0 0 10px rgba(108,99,255,0.5);
    }

    .timeline-dot.done {
        background: var(--accent);
        border-color: var(--accent);
    }

    .timeline-line {
        position: relative;
    }

    .timeline-step-title {
        font-weight: 600;
        font-size: 0.88rem;
        margin-bottom: 2px;
    }

    .timeline-step-desc {
        font-size: 0.78rem;
        color: var(--text-muted);
    }

    .error-msg-box {
        background: rgba(255,101,132,0.08);
        border: 1px solid rgba(255,101,132,0.3);
        border-radius: 14px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 14px;
        color: var(--secondary);
        font-size: 0.9rem;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-muted);
    }

    .empty-state-icon { font-size: 4rem; margin-bottom: 1rem; }
    .empty-state-title { font-size: 1.3rem; font-weight: 700; color: var(--text-secondary); margin-bottom: 0.5rem; }
    .empty-state-desc { font-size: 0.9rem; line-height: 1.6; }

    @media (max-width: 600px) {
        .track-form { flex-direction: column; }
        .result-card-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
    }
</style>
@endpush

@section('content')

<section class="track-page">
    <div class="container track-container">

        <!-- Search Card -->
        <div class="track-search-card">
            <div class="track-icon"><i class="fas fa-search" style="color: var(--primary-light)"></i></div>
            <h1 class="track-title">Cek Status Pesanan</h1>
            <p class="track-subtitle">Masukkan nomor pesanan untuk melihat status top up kamu</p>

            <form method="GET" action="{{ route('order.track') }}" class="track-form">
                <input type="text"
                       name="order_number"
                       class="form-control"
                       placeholder="Contoh: PTU20240101ABC123"
                       value="{{ request('order_number') }}"
                       required>
                <button type="submit" class="btn btn-primary" style="white-space:nowrap">
                    <i class="fas fa-search"></i> Cek Pesanan
                </button>
            </form>
        </div>

        <!-- Error -->
        @if(isset($error) && $error)
        <div class="error-msg-box">
            <i class="fas fa-exclamation-circle" style="font-size:1.5rem;flex-shrink:0"></i>
            <div>
                <strong>Pesanan Tidak Ditemukan</strong><br>
                {{ $error }}
            </div>
        </div>

        <!-- Result -->
        @elseif(isset($order) && $order)

        @php
        $emojis = [
            'mobile-legends' => '⚔️', 'pubg-mobile' => '🎯', 'free-fire' => '🔥',
            'genshin-impact' => '🌟', 'honkai-star-rail' => '🚀', 'valorant' => '💥',
            'roblox' => '🧱', 'league-of-legends' => '🏆', 'arena-of-valor' => '🛡️',
            'minecraft' => '⛏️',
        ];
        $emoji = $emojis[$order->product->game->slug] ?? '🎮';
        @endphp

        <div class="result-card">
            <div class="result-card-header">
                <div class="rch-left">
                    <div class="rch-icon">{{ $emoji }}</div>
                    <div>
                        <div class="rch-title">{{ $order->product->game->name }}</div>
                        <div class="rch-order">#{{ $order->order_number }}</div>
                    </div>
                </div>
                @if($order->status === 'pending')
                <span class="badge badge-warning" style="font-size:0.82rem;padding:6px 14px">⏳ Menunggu Pembayaran</span>
                @elseif($order->status === 'paid')
                <span class="badge badge-info" style="font-size:0.82rem;padding:6px 14px">💳 Dibayar</span>
                @elseif($order->status === 'processing')
                <span class="badge badge-primary" style="font-size:0.82rem;padding:6px 14px">⚡ Diproses</span>
                @elseif($order->status === 'completed')
                <span class="badge badge-success" style="font-size:0.82rem;padding:6px 14px">✅ Selesai</span>
                @elseif($order->status === 'failed')
                <span class="badge badge-danger" style="font-size:0.82rem;padding:6px 14px">❌ Gagal</span>
                @else
                <span class="badge badge-secondary" style="font-size:0.82rem;padding:6px 14px">{{ $order->status }}</span>
                @endif
            </div>

            <div class="result-card-body">
                <div class="result-row">
                    <span class="rr-label">Paket Top Up</span>
                    <span class="rr-val">{{ $order->product->amount }} {{ $order->product->unit }}</span>
                </div>
                <div class="result-row">
                    <span class="rr-label">ID Akun Game</span>
                    <span class="rr-val">{{ $order->game_user_id }}</span>
                </div>
                @if($order->game_server)
                <div class="result-row">
                    <span class="rr-label">Server</span>
                    <span class="rr-val">{{ $order->game_server }}</span>
                </div>
                @endif
                <div class="result-row">
                    <span class="rr-label">Nama Pembeli</span>
                    <span class="rr-val">{{ $order->buyer_name }}</span>
                </div>
                <div class="result-row">
                    <span class="rr-label">Email</span>
                    <span class="rr-val">{{ $order->buyer_email }}</span>
                </div>
                <div class="result-row">
                    <span class="rr-label">Metode Pembayaran</span>
                    <span class="rr-val">{{ $order->payment_channel }}</span>
                </div>
                <div class="result-row">
                    <span class="rr-label">Harga Produk</span>
                    <span class="rr-val">Rp {{ number_format($order->amount, 0, ',', '.') }}</span>
                </div>
                <div class="result-row">
                    <span class="rr-label">Biaya Admin</span>
                    <span class="rr-val">Rp {{ number_format($order->admin_fee, 0, ',', '.') }}</span>
                </div>
                <div class="result-row">
                    <span class="rr-label">Total Bayar</span>
                    <span class="rr-val" style="color:var(--primary-light);font-size:1.1rem">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="result-row">
                    <span class="rr-label">Waktu Pesan</span>
                    <span class="rr-val">{{ $order->created_at->format('d M Y H:i') }}</span>
                </div>

                <!-- Timeline -->
                <div class="timeline">
                    <div class="timeline-title"><i class="fas fa-history"></i> Riwayat Status</div>

                    @php
                    $steps = [
                        ['key' => 'created', 'label' => 'Pesanan Dibuat', 'desc' => 'Pesanan berhasil dibuat', 'always' => true],
                        ['key' => 'paid', 'label' => 'Pembayaran Diterima', 'desc' => 'Pembayaran telah dikonfirmasi'],
                        ['key' => 'processing', 'label' => 'Sedang Diproses', 'desc' => 'Top up sedang diproses ke akun'],
                        ['key' => 'completed', 'label' => 'Selesai', 'desc' => 'Top up berhasil masuk ke akun game'],
                    ];
                    $statusOrder = ['pending' => 0, 'paid' => 1, 'processing' => 2, 'completed' => 3, 'failed' => 4, 'cancelled' => 4];
                    $currentLevel = $statusOrder[$order->status] ?? 0;
                    @endphp

                    @foreach($steps as $i => $step)
                    <div class="timeline-item">
                        <div class="timeline-dot {{ $currentLevel > $i ? 'done' : ($currentLevel === $i ? 'active' : '') }}"></div>
                        <div>
                            <div class="timeline-step-title" style="color: {{ $currentLevel >= $i ? 'white' : 'var(--text-muted)' }}">{{ $step['label'] }}</div>
                            <div class="timeline-step-desc">{{ $step['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach

                    @if($order->status === 'failed')
                    <div class="timeline-item">
                        <div class="timeline-dot active" style="background:var(--secondary);border-color:var(--secondary);box-shadow:0 0 10px rgba(255,101,132,0.5)"></div>
                        <div>
                            <div class="timeline-step-title" style="color:var(--secondary)">Transaksi Gagal</div>
                            <div class="timeline-step-desc">Hubungi CS untuk prses refund</div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Actions -->
                <div style="margin-top:1.5rem;display:flex;gap:1rem;flex-wrap:wrap;">
                    @if($order->status === 'pending')
                    <a href="{{ route('payment.show', $order->order_number) }}" class="btn btn-primary">
                        <i class="fas fa-credit-card"></i> Lanjutkan Bayar
                    </a>
                    @elseif($order->status === 'completed')
                    <a href="{{ route('payment.success', $order->order_number) }}" class="btn btn-success">
                        <i class="fas fa-check-circle"></i> Lihat Detail
                    </a>
                    @endif
                    <a href="{{ route('home') }}" class="btn btn-outline">
                        <i class="fas fa-gamepad"></i> Top Up Lagi
                    </a>
                </div>
            </div>
        </div>

        <!-- Empty state -->
        @else
        <div class="empty-state">
            <div class="empty-state-icon">🔍</div>
            <div class="empty-state-title">Belum Ada Pencarian</div>
            <p class="empty-state-desc">
                Masukkan nomor pesanan untuk melacak status top up kamu.<br>
                Nomor pesanan dikirim ke email setelah transaksi dibuat.
            </p>
        </div>
        @endif

    </div>
</section>

@endsection
