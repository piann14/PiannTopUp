@extends('layouts.app')

@section('title', 'Pembayaran #' . $order->order_number . ' - PiannTopUp')

@push('styles')
<style>
    .payment-page {
        min-height: calc(100vh - 70px);
        padding: 3rem 0;
        background: radial-gradient(ellipse 70% 50% at 50% 20%, rgba(108,99,255,0.1) 0%, transparent 60%);
    }

    .payment-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .payment-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 2rem;
    }

    .payment-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 20px;
        overflow: hidden;
    }

    .payment-card-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--dark-border);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pch-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(108,99,255,0.15);
        color: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .pch-title { font-weight: 700; font-size: 1.1rem; }
    .pch-sub { color: var(--text-muted); font-size: 0.82rem; }

    .payment-card-body { padding: 2rem; }

    /* Timer */
    .payment-timer {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        background: rgba(255,101,132,0.1);
        border: 1px solid rgba(255,101,132,0.3);
        border-radius: 12px;
        margin-bottom: 2rem;
        color: var(--secondary);
        font-size: 0.9rem;
        font-weight: 600;
    }

    #timerDisplay {
        font-size: 1.1rem;
        font-weight: 800;
        font-variant-numeric: tabular-nums;
    }

    /* Method specific */
    .pay-method-section {
        text-align: center;
    }

    .pay-amount-box {
        background: var(--gradient-primary);
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .pay-amount-label {
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        opacity: 0.85;
    }

    .pay-amount-value {
        font-size: 2.5rem;
        font-weight: 900;
        letter-spacing: -1px;
    }

    .pay-amount-note {
        font-size: 0.78rem;
        opacity: 0.8;
        margin-top: 4px;
    }

    /* VA Number */
    .va-section {
        background: var(--dark-card2);
        border: 1px solid var(--dark-border);
        border-radius: 14px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .va-label {
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-bottom: 0.8rem;
    }

    .va-number-box {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .va-number {
        font-size: 1.6rem;
        font-weight: 800;
        letter-spacing: 2px;
        flex: 1;
        font-variant-numeric: tabular-nums;
    }

    .btn-copy {
        padding: 10px 16px;
        background: rgba(108,99,255,0.15);
        border: 1px solid rgba(108,99,255,0.4);
        border-radius: 10px;
        color: var(--primary-light);
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        font-family: 'Inter', sans-serif;
    }

    .btn-copy:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* QRIS */
    .qris-container {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .qris-box {
        display: inline-block;
        padding: 1.5rem;
        background: white;
        border-radius: 16px;
        margin-bottom: 1rem;
    }

    .qris-placeholder {
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, #333 25%, transparent 25%) -20px 0,
                    linear-gradient(225deg, #333 25%, transparent 25%) -20px 0,
                    linear-gradient(315deg, #333 25%, transparent 25%),
                    linear-gradient(45deg, #333 25%, transparent 25%);
        background-size: 40px 40px;
        background-color: #f5f5f5;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }

    /* Retail/Minimarket */
    .retail-code-box {
        background: var(--dark-card2);
        border: 2px dashed var(--dark-border);
        border-radius: 14px;
        padding: 2rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .retail-code-label {
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-bottom: 0.8rem;
    }

    .retail-code {
        font-size: 2rem;
        font-weight: 900;
        letter-spacing: 4px;
        margin-bottom: 1rem;
        font-variant-numeric: tabular-nums;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Steps */
    .pay-steps {
        background: var(--dark-card2);
        border: 1px solid var(--dark-border);
        border-radius: 14px;
        padding: 1.5rem;
    }

    .pay-steps-title {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        color: var(--text-secondary);
    }

    .pay-step-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 0.5rem 0;
    }

    .pay-step-num {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: rgba(108,99,255,0.15);
        color: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.72rem;
        font-weight: 700;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .pay-step-text {
        font-size: 0.85rem;
        color: var(--text-secondary);
        line-height: 1.5;
    }

    /* Simulate Pay Button */
    .simulate-btn {
        margin-top: 1.5rem;
        padding: 1rem;
        background: rgba(67,233,123,0.08);
        border: 2px dashed rgba(67,233,123,0.3);
        border-radius: 14px;
        text-align: center;
    }

    .simulate-note {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 0.8rem;
    }

    /* Order Summary sidebar */
    .order-detail-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 20px;
        overflow: hidden;
        position: sticky;
        top: 90px;
    }

    .odc-header {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid var(--dark-border);
        font-weight: 700;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .odc-body { padding: 1.5rem; }

    .odc-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.9rem;
        font-size: 0.85rem;
        gap: 1rem;
    }

    .odc-label { color: var(--text-muted); flex-shrink: 0; }
    .odc-val { font-weight: 600; text-align: right; word-break: break-all; }

    .odc-divider { border: none; border-top: 1px solid var(--dark-border); margin: 1rem 0; }

    .odc-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 800;
        font-size: 1rem;
    }

    .odc-total-val {
        font-size: 1.3rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-pending {
        background: rgba(255,215,0,0.1);
        color: var(--gold);
        border: 1px solid rgba(255,215,0,0.3);
    }

    .status-completed {
        background: rgba(67,233,123,0.1);
        color: var(--accent);
        border: 1px solid rgba(67,233,123,0.3);
    }

    @media (max-width: 900px) {
        .payment-layout { grid-template-columns: 1fr; }
        .order-detail-card { position: static; }
    }

    @media (max-width: 600px) {
        .pay-amount-value { font-size: 1.8rem; }
        .va-number { font-size: 1.2rem; }
        .retail-code { font-size: 1.5rem; }
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

    $payMethod = $order->payment_method;
    $isBank = in_array($payMethod, ['bca_va','bni_va','mandiri_va','bri_va','bsi_va','cimb_va']);
    $isEwallet = in_array($payMethod, ['gopay','ovo','dana','shopeepay','linkaja','jenius']);
    $isQris = $payMethod === 'qris';
    $isRetail = in_array($payMethod, ['indomaret','alfamart','alfamidi','circlek']);

    // Generate dummy numbers
    $vaNumber = '808' . substr(str_replace('-', '', $order->order_number), -10);
    $retailCode = strtoupper(substr(md5($order->order_number), 0, 12));
@endphp

<section class="payment-page">
    <div class="container payment-container">

        <div style="margin-bottom: 2rem;">
            <div style="display:flex;align-items:center;gap:8px;font-size:0.82rem;color:var(--text-muted);">
                <a href="{{ route('home') }}" style="color:var(--text-muted);text-decoration:none">Beranda</a>
                <i class="fas fa-chevron-right"></i>
                <span style="color:var(--primary-light)">Pembayaran</span>
            </div>
        </div>

        <div class="payment-layout">
            <!-- LEFT -->
            <div>
                <div class="payment-card">
                    <div class="payment-card-header">
                        <div class="pch-icon"><i class="fas fa-credit-card"></i></div>
                        <div>
                            <div class="pch-title">Selesaikan Pembayaran</div>
                            <div class="pch-sub">Order #{{ $order->order_number }}</div>
                        </div>
                    </div>
                    <div class="payment-card-body">

                        @if($order->status === 'pending')
                        <!-- Timer -->
                        <div class="payment-timer">
                            <i class="fas fa-clock"></i>
                            Bayar sebelum:
                            <span id="timerDisplay">00:00:00</span>
                        </div>
                        @endif

                        <!-- Amount -->
                        <div class="pay-amount-box">
                            <div class="pay-amount-label">Total yang Harus Dibayar</div>
                            <div class="pay-amount-value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            <div class="pay-amount-note">Bayar tepat sesuai nominal tertera</div>
                        </div>

                        @if($isBank)
                        <!-- BANK TRANSFER -->
                        <div class="va-section">
                            <div class="va-label"><i class="fas fa-university"></i> Nomor Virtual Account {{ strtoupper(str_replace('_va', '', $payMethod)) }}</div>
                            <div class="va-number-box">
                                <div class="va-number" id="vaNumber">{{ $vaNumber }}</div>
                                <button class="btn-copy" onclick="copyText('{{ $vaNumber }}', this)">
                                    <i class="fas fa-copy"></i> Salin
                                </button>
                            </div>
                        </div>
                        <div class="pay-steps">
                            <div class="pay-steps-title"><i class="fas fa-list-ol"></i> Cara Bayar via {{ $order->payment_channel }}</div>
                            @if($payMethod === 'bca_va')
                            @foreach(['Buka aplikasi BCA Mobile', 'Pilih m-Transfer → BCA Virtual Account', 'Masukkan nomor VA di atas', 'Masukkan jumlah pembayaran', 'Konfirmasi dan selesai!'] as $i => $step)
                            <div class="pay-step-item">
                                <div class="pay-step-num">{{ $i+1 }}</div>
                                <div class="pay-step-text">{{ $step }}</div>
                            </div>
                            @endforeach
                            @else
                            @foreach(['Buka aplikasi mobile banking Anda', 'Pilih menu Transfer / Virtual Account', 'Masukkan nomor VA di atas', 'Periksa detail dan konfirmasi pembayaran', 'Pembayaran berhasil!'] as $i => $step)
                            <div class="pay-step-item">
                                <div class="pay-step-num">{{ $i+1 }}</div>
                                <div class="pay-step-text">{{ $step }}</div>
                            </div>
                            @endforeach
                            @endif
                        </div>

                        @elseif($isEwallet)
                        <!-- E-WALLET -->
                        <div class="qris-container">
                            <div class="qris-box">
                                <div class="qris-placeholder">{{ $emoji }}</div>
                            </div>
                            <div style="font-size:0.82rem;color:var(--text-muted)">Atau buka link pembayaran</div>
                        </div>
                        <div class="pay-steps">
                            <div class="pay-steps-title"><i class="fas fa-list-ol"></i> Cara Bayar via {{ $order->payment_channel }}</div>
                            @foreach(['Buka aplikasi ' . $order->payment_channel, 'Pilih menu Bayar / Pay', 'Scan QR Code di atas', 'Masukkan PIN untuk konfirmasi', 'Pembayaran berhasil!'] as $i => $step)
                            <div class="pay-step-item">
                                <div class="pay-step-num">{{ $i+1 }}</div>
                                <div class="pay-step-text">{{ $step }}</div>
                            </div>
                            @endforeach
                        </div>

                        @elseif($isQris)
                        <!-- QRIS -->
                        <div class="qris-container">
                            <div class="qris-box">
                                <div class="qris-placeholder">📱</div>
                            </div>
                            <div style="font-size:0.82rem;color:var(--text-muted);margin-top:0.5rem;">Scan dengan aplikasi apapun yang mendukung QRIS</div>
                        </div>
                        <div class="pay-steps">
                            <div class="pay-steps-title"><i class="fas fa-list-ol"></i> Cara Bayar via QRIS</div>
                            @foreach(['Buka aplikasi Bank atau E-Wallet apapun', 'Pilih fitur Scan QR / QRIS', 'Arahkan kamera ke QR Code di atas', 'Pastikan total sesuai, lalu konfirmasi', 'Pembayaran berhasil!'] as $i => $step)
                            <div class="pay-step-item">
                                <div class="pay-step-num">{{ $i+1 }}</div>
                                <div class="pay-step-text">{{ $step }}</div>
                            </div>
                            @endforeach
                        </div>

                        @elseif($isRetail)
                        <!-- RETAIL -->
                        <div class="retail-code-box">
                            <div class="retail-code-label"><i class="fas fa-store"></i> Kode Pembayaran {{ $order->payment_channel }}</div>
                            <div class="retail-code" id="retailCode">{{ $retailCode }}</div>
                            <button class="btn-copy" onclick="copyText('{{ $retailCode }}', this)" style="margin-top: 0.5rem;">
                                <i class="fas fa-copy"></i> Salin Kode
                            </button>
                        </div>
                        <div class="pay-steps">
                            <div class="pay-steps-title"><i class="fas fa-list-ol"></i> Cara Bayar di {{ $order->payment_channel }}</div>
                            @foreach(['Pergi ke gerai ' . $order->payment_channel . ' terdekat', 'Berikan kode di atas ke kasir', 'Sebutkan jumlah pembayaran: Rp ' . number_format($order->total_amount, 0, ',', '.'), 'Simpan struk sebagai bukti pembayaran', 'Pembayaran diproses otomatis!'] as $i => $step)
                            <div class="pay-step-item">
                                <div class="pay-step-num">{{ $i+1 }}</div>
                                <div class="pay-step-text">{{ $step }}</div>
                            </div>
                            @endforeach
                        </div>

                        @else
                        <!-- DEFAULT -->
                        <div class="pay-steps">
                            <div class="pay-steps-title">Cara Pembayaran</div>
                            <div class="pay-step-item">
                                <div class="pay-step-num">1</div>
                                <div class="pay-step-text">Ikuti instruksi dari metode pembayaran yang dipilih</div>
                            </div>
                            <div class="pay-step-item">
                                <div class="pay-step-num">2</div>
                                <div class="pay-step-text">Bayar sejumlah Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                            </div>
                            <div class="pay-step-item">
                                <div class="pay-step-num">3</div>
                                <div class="pay-step-text">Tunggu konfirmasi otomatis dari sistem kami</div>
                            </div>
                        </div>
                        @endif

                        <!-- DEMO: Simulate Payment Button -->
                        @if($order->status === 'pending')
                        <div class="simulate-btn">
                            <div class="simulate-note">🔧 Mode Demo - Tombol ini mensimulasikan pembayaran berhasil</div>
                            <a href="{{ route('payment.simulate', $order->order_number) }}"
                               class="btn btn-success btn-block"
                               onclick="return confirm('Simulasi pembayaran berhasil? (Hanya untuk demo)')">
                                <i class="fas fa-check-circle"></i> Simulasi Bayar Berhasil
                            </a>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div>
                <div class="order-detail-card">
                    <div class="odc-header">
                        <i class="fas fa-receipt" style="color:var(--primary-light)"></i>
                        Detail Pesanan
                    </div>
                    <div class="odc-body">

                        <div style="display:flex;align-items:center;gap:12px;padding-bottom:1.2rem;border-bottom:1px solid var(--dark-border);margin-bottom:1.2rem;">
                            <div style="width:48px;height:48px;border-radius:12px;background:var(--dark-card2);display:flex;align-items:center;justify-content:center;font-size:1.8rem;flex-shrink:0;">{{ $emoji }}</div>
                            <div>
                                <div style="font-weight:700;font-size:0.95rem;">{{ $order->product->game->name }}</div>
                                <div style="font-size:0.8rem;color:var(--text-muted);">{{ $order->product->amount }} {{ $order->product->unit }}</div>
                            </div>
                        </div>

                        <div class="odc-row">
                            <span class="odc-label">No. Pesanan</span>
                            <span class="odc-val" style="font-size:0.8rem;">{{ $order->order_number }}</span>
                        </div>
                        <div class="odc-row">
                            <span class="odc-label">ID Akun</span>
                            <span class="odc-val">{{ $order->game_user_id }}</span>
                        </div>
                        @if($order->game_server)
                        <div class="odc-row">
                            <span class="odc-label">Server</span>
                            <span class="odc-val">{{ $order->game_server }}</span>
                        </div>
                        @endif
                        <div class="odc-row">
                            <span class="odc-label">Pembeli</span>
                            <span class="odc-val">{{ $order->buyer_name }}</span>
                        </div>
                        <div class="odc-row">
                            <span class="odc-label">Email</span>
                            <span class="odc-val" style="font-size:0.8rem;">{{ $order->buyer_email }}</span>
                        </div>
                        <div class="odc-row">
                            <span class="odc-label">Metode Bayar</span>
                            <span class="odc-val">{{ $order->payment_channel }}</span>
                        </div>
                        <div class="odc-row">
                            <span class="odc-label">Status</span>
                            <span class="odc-val">
                                @if($order->status === 'pending')
                                <span class="status-badge status-pending"><i class="fas fa-clock"></i> Menunggu</span>
                                @elseif($order->status === 'completed')
                                <span class="status-badge status-completed"><i class="fas fa-check-circle"></i> Selesai</span>
                                @else
                                <span class="badge badge-secondary">{{ $order->status }}</span>
                                @endif
                            </span>
                        </div>

                        <hr class="odc-divider">

                        <div class="odc-row">
                            <span class="odc-label">Harga Produk</span>
                            <span class="odc-val">Rp {{ number_format($order->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="odc-row">
                            <span class="odc-label">Biaya Admin</span>
                            <span class="odc-val">Rp {{ number_format($order->admin_fee, 0, ',', '.') }}</span>
                        </div>

                        <hr class="odc-divider">

                        <div class="odc-total">
                            <span>Total</span>
                            <span class="odc-total-val">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>

                        <div style="margin-top:1.5rem;">
                            <a href="{{ route('order.track') }}?order_number={{ $order->order_number }}"
                               class="btn btn-outline btn-block btn-sm">
                                <i class="fas fa-search"></i> Cek Status Pesanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    // =================== TIMER ===================
    @if($order->status === 'pending')
    const deadline = new Date();
    deadline.setMinutes(deadline.getMinutes() + 60);

    function updateTimer() {
        const now = new Date();
        const diff = deadline - now;

        if (diff <= 0) {
            document.getElementById('timerDisplay').textContent = 'EXPIRED';
            return;
        }

        const h = Math.floor(diff / 3600000);
        const m = Math.floor((diff % 3600000) / 60000);
        const s = Math.floor((diff % 60000) / 1000);

        document.getElementById('timerDisplay').textContent =
            String(h).padStart(2,'0') + ':' +
            String(m).padStart(2,'0') + ':' +
            String(s).padStart(2,'0');
    }

    updateTimer();
    setInterval(updateTimer, 1000);

    // Auto-check payment status
    let statusCheckInterval = setInterval(() => {
        fetch('{{ route("payment.status", $order->order_number) }}')
            .then(r => r.json())
            .then(data => {
                if (data.status !== 'pending') {
                    clearInterval(statusCheckInterval);
                    if (data.status === 'completed') {
                        showToast('Pembayaran berhasil! Mengarahkan...', 'success');
                        setTimeout(() => window.location.href = '{{ route("payment.success", $order->order_number) }}', 1500);
                    }
                }
            });
    }, 5000);
    @endif

    // =================== COPY ===================
    function copyText(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Disalin!';
            btn.style.background = 'var(--accent)';
            btn.style.color = '#0a2a1a';
            btn.style.borderColor = 'var(--accent)';
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.style.background = '';
                btn.style.color = '';
                btn.style.borderColor = '';
            }, 2000);
            showToast('Berhasil disalin ke clipboard!', 'success');
        });
    }
</script>
@endpush
