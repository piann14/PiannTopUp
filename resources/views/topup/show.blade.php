@extends('layouts.app')

@section('title', 'Top Up ' . $game->name . ' - PiannTopUp')

@push('styles')
<style>
    /* =================== GAME HERO =================== */
    .game-hero {
        background: var(--dark-card);
        border-bottom: 1px solid var(--dark-border);
        padding: 2.5rem 0;
        position: relative;
        overflow: hidden;
    }

    .game-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 80% 100% at 60% 50%, rgba(108,99,255,0.12) 0%, transparent 65%);
    }

    .game-hero-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .game-hero-img {
        width: 100px;
        height: 100px;
        border-radius: 20px;
        background: var(--dark-card2);
        border: 2px solid var(--dark-border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        flex-shrink: 0;
        box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        overflow: hidden;
    }

    .game-hero-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 18px;
    }

    .game-hero-info {}

    .game-hero-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }

    .game-hero-breadcrumb a {
        color: var(--text-muted);
        text-decoration: none;
        transition: color 0.3s;
    }
    .game-hero-breadcrumb a:hover { color: var(--primary-light); }

    .game-hero-name {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .game-hero-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .game-hero-tag {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.82rem;
        color: var(--text-muted);
    }

    /* =================== TOPUP LAYOUT =================== */
    .topup-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 2rem;
        padding: 2.5rem 0;
    }

    /* =================== STEP =================== */
    .step-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        transition: border-color 0.3s ease;
    }

    .step-card.active-step {
        border-color: rgba(108,99,255,0.5);
    }

    .step-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .step-num {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.9rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(108,99,255,0.4);
    }

    .step-title {
        font-size: 1.1rem;
        font-weight: 700;
    }

    .step-subtitle {
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-top: 2px;
    }

    /* =================== FORM =================== */
    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
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

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.15);
    }

    .form-control::placeholder { color: var(--text-muted); }

    .form-control.error { border-color: var(--secondary); }
    .form-control.success { border-color: var(--accent); }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .input-group {
        display: flex;
        align-items: stretch;
    }

    .input-group .form-control {
        border-radius: 12px 0 0 12px;
        border-right: none;
    }

    .input-group-btn {
        padding: 0 1.2rem;
        background: var(--gradient-primary);
        border: none;
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        border-radius: 0 12px 12px 0;
        white-space: nowrap;
        font-family: 'Inter', sans-serif;
        transition: opacity 0.3s;
    }

    .input-group-btn:hover { opacity: 0.9; }

    .user-check-result {
        margin-top: 0.7rem;
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
        display: none;
    }

    .user-check-result.success {
        background: rgba(67,233,123,0.1);
        border: 1px solid rgba(67,233,123,0.3);
        color: var(--accent);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .user-check-result.error-msg {
        background: rgba(255,101,132,0.1);
        border: 1px solid rgba(255,101,132,0.3);
        color: var(--secondary);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* =================== PRODUCTS =================== */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.9rem;
    }

    .product-item {
        padding: 1rem;
        background: var(--dark-card2);
        border: 2px solid var(--dark-border);
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.25s ease;
        position: relative;
        user-select: none;
    }

    .product-item:hover {
        border-color: rgba(108,99,255,0.5);
        background: rgba(108,99,255,0.05);
    }

    .product-item.selected {
        border-color: var(--primary);
        background: rgba(108,99,255,0.1);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.2);
    }

    .product-item.popular::after {
        content: '🔥 HOT';
        position: absolute;
        top: -10px;
        right: 10px;
        background: var(--gradient-primary);
        color: white;
        font-size: 0.62rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 10px;
    }

    .product-amount {
        font-size: 1.1rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.2rem;
    }

    .product-unit {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }

    .product-price {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--primary-light);
    }

    .product-orig-price {
        font-size: 0.72rem;
        color: var(--text-muted);
        text-decoration: line-through;
    }

    .product-discount {
        position: absolute;
        top: -10px;
        left: 10px;
        background: var(--secondary);
        color: white;
        font-size: 0.62rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 10px;
    }

    .product-check {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--primary);
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 0.65rem;
        color: white;
    }

    .product-item.selected .product-check { display: flex; }

    /* =================== PAYMENT TABS =================== */
    .payment-tabs {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.2rem;
    }

    .pay-tab-btn {
        padding: 7px 14px;
        border-radius: 8px;
        border: 1px solid var(--dark-border);
        background: transparent;
        color: var(--text-secondary);
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
    }

    .pay-tab-btn.active {
        background: var(--gradient-primary);
        border-color: transparent;
        color: white;
    }

    .payment-options {
        display: none;
        grid-template-columns: 1fr 1fr;
        gap: 0.7rem;
    }

    .payment-options.active { display: grid; }

    .pay-option {
        padding: 10px 12px;
        background: var(--dark-card2);
        border: 1px solid var(--dark-border);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
    }

    .pay-option:hover { border-color: rgba(108,99,255,0.5); }

    .pay-option.selected {
        border-color: var(--primary);
        background: rgba(108,99,255,0.1);
    }

    .pay-option-icon { font-size: 1.1rem; }
    .pay-option-name { font-weight: 600; flex: 1; }

    .pay-option-fee {
        font-size: 0.72rem;
        color: var(--text-muted);
    }

    /* =================== ORDER SUMMARY (SIDEBAR) =================== */
    .order-summary {
        position: sticky;
        top: 90px;
    }

    .summary-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 20px;
        overflow: hidden;
    }

    .summary-header {
        padding: 1.5rem 1.5rem 1rem;
        border-bottom: 1px solid var(--dark-border);
        font-weight: 700;
        font-size: 1rem;
    }

    .summary-body {
        padding: 1.5rem;
    }

    .summary-game {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--dark-border);
    }

    .summary-game-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: var(--dark-card2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        flex-shrink: 0;
        overflow: hidden;
    }

    .summary-game-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 11px;
    }

    .summary-game-name { font-weight: 700; font-size: 0.95rem; }
    .summary-game-id { color: var(--text-muted); font-size: 0.8rem; margin-top: 2px; }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
        font-size: 0.88rem;
    }

    .summary-label { color: var(--text-secondary); }

    .summary-value { font-weight: 600; }

    .summary-divider {
        border: none;
        border-top: 1px solid var(--dark-border);
        margin: 1rem 0;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 800;
        font-size: 1.1rem;
    }

    .summary-total-amount {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 1.3rem;
    }

    .summary-footer {
        padding: 1.5rem;
        border-top: 1px solid var(--dark-border);
    }

    .empty-product-msg {
        text-align: center;
        padding: 2rem;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .trust-badges {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1rem;
        justify-content: center;
    }

    .trust-badge {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    /* =================== RESPONSIVE =================== */
    @media (max-width: 1100px) {
        .topup-layout { grid-template-columns: 1fr 340px; }
        .products-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 900px) {
        .topup-layout { grid-template-columns: 1fr; }
        .order-summary { position: static; }
        .products-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 600px) {
        .products-grid { grid-template-columns: repeat(2, 1fr); }
        .form-row { grid-template-columns: 1fr; }
        .payment-options { grid-template-columns: 1fr; }
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
    $emoji = $emojis[$game->slug] ?? '🎮';
    // Gunakan gambar PNG langsung
    $gameImgUrl = asset('images/games/' . $game->slug . '.png');
@endphp

<!-- GAME HERO -->
<div class="game-hero">
    <div class="container">
        <div class="game-hero-content">
            <div class="game-hero-img">
                <img src="{{ $gameImgUrl }}" alt="{{ $game->name }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <span style="display:none;font-size:48px;">{{ $emoji }}</span>
            </div>
            <div class="game-hero-info">
                <div class="game-hero-breadcrumb">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Top Up</span>
                    <i class="fas fa-chevron-right"></i>
                    <span style="color: var(--primary-light)">{{ $game->name }}</span>
                </div>
                <h1 class="game-hero-name">Top Up {{ $game->name }}</h1>
                <div class="game-hero-meta">
                    <span class="game-hero-tag"><i class="fas fa-tag"></i> {{ ucfirst($game->category) }}</span>
                    @if($game->publisher)
                    <span class="game-hero-tag"><i class="fas fa-building"></i> {{ $game->publisher }}</span>
                    @endif
                    <span class="game-hero-tag"><i class="fas fa-cubes"></i> {{ $game->activeProducts->count() }} Paket Tersedia</span>
                    <span class="badge badge-success"><i class="fas fa-bolt"></i> Proses Otomatis</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="topup-layout">
        <!-- =================== LEFT COLUMN =================== -->
        <div class="topup-form">

            <!-- STEP 1: USER ID -->
            <div class="step-card active-step" id="step1">
                <div class="step-header">
                    <div class="step-num">1</div>
                    <div>
                        <div class="step-title">Masukkan ID Akun Game</div>
                        <div class="step-subtitle">Pastikan ID yang dimasukkan sudah benar</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">User ID / Player ID <span style="color: var(--secondary)">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="gameUserId" placeholder="Masukkan ID akun" oninput="resetUserCheck()">
                            <button class="input-group-btn" onclick="checkUser()">Cek ID</button>
                        </div>
                        <div class="user-check-result" id="userCheckResult"></div>
                    </div>
                    @php
                    $needServer = in_array($game->slug, ['mobile-legends', 'arena-of-valor']);
                    @endphp
                    @if($needServer)
                    <div class="form-group">
                        <label class="form-label">Server <span style="color: var(--secondary)">*</span></label>
                        <select class="form-control" id="gameServer">
                            <option value="">-- Pilih Server --</option>
                            @if($game->slug === 'mobile-legends')
                            @foreach(['1001 - Langrisser', '1002 - Moniyan', '1003 - Celestial', '1004 - Solaris', '1005 - Dragon Altar', '2001 - Royal Castle', '3001 - Eruditio'] as $srv)
                            <option value="{{ $srv }}">{{ $srv }}</option>
                            @endforeach
                            @else
                            @foreach(['1 - Asia', '2 - Europe', '3 - America', '4 - Middle East'] as $srv)
                            <option value="{{ $srv }}">{{ $srv }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    @endif
                </div>

                <div style="background: rgba(108,99,255,0.07); border: 1px solid rgba(108,99,255,0.2); border-radius: 12px; padding: 1rem; font-size: 0.82rem; color: var(--text-secondary); line-height: 1.6;">
                    <strong style="color: var(--primary-light)"><i class="fas fa-info-circle"></i> Cara Menemukan ID:</strong>
                    @if($game->slug === 'mobile-legends')
                    Buka ML → Klik profil → Salin ID di bawah nama karakter (format: 123456789(1234))
                    @elseif($game->slug === 'pubg-mobile')
                    Buka PUBG → Klik profil → ID tertera di bawah foto profil
                    @elseif($game->slug === 'free-fire')
                    Buka FF → Klik profil dari menu utama → Salin UID yang tertera
                    @elseif($game->slug === 'genshin-impact')
                    Buka Genshin → Menu → Klik avatar → UID tertera di pojok kanan bawah
                    @else
                    Buka game → Masuk ke profil/akun → Salin User ID yang tertera
                    @endif
                </div>
            </div>

            <!-- STEP 2: PRODUCTS -->
            <div class="step-card" id="step2">
                <div class="step-header">
                    <div class="step-num">2</div>
                    <div>
                        <div class="step-title">Pilih Nominal Top Up</div>
                        <div class="step-subtitle">Pilih paket yang sesuai kebutuhanmu</div>
                    </div>
                </div>

                <div class="products-grid">
                    @foreach($game->activeProducts as $product)
                    <div class="product-item {{ $product->is_popular ? 'popular' : '' }}"
                         data-id="{{ $product->id }}"
                         data-price="{{ $product->price }}"
                         data-original="{{ $product->original_price }}"
                         data-name="{{ $product->amount }} {{ $product->unit }}"
                         onclick="selectProduct(this)">
                        @if($product->original_price && $product->original_price > $product->price)
                        <div class="product-discount">-{{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}%</div>
                        @endif
                        <div class="product-check"><i class="fas fa-check"></i></div>
                        <div class="product-amount">{{ number_format($product->amount, 0, ',', '.') }}</div>
                        <div class="product-unit">{{ $product->unit }}</div>
                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        @if($product->original_price && $product->original_price > $product->price)
                        <div class="product-orig-price">Rp {{ number_format($product->original_price, 0, ',', '.') }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- STEP 3: PAYMENT -->
            <div class="step-card" id="step3">
                <div class="step-header">
                    <div class="step-num">3</div>
                    <div>
                        <div class="step-title">Pilih Metode Pembayaran</div>
                        <div class="step-subtitle">Bayar dengan cara yang paling mudah bagimu</div>
                    </div>
                </div>

                <div class="payment-tabs">
                    @php
                    $categories = [
                        'bank_transfer' => '🏦 Transfer Bank',
                        'e_wallet' => '📱 E-Wallet',
                        'qris' => '📲 QRIS',
                        'retail' => '🏪 Minimarket',
                        'paylater' => '💸 PayLater',
                    ];
                    $firstCat = true;
                    @endphp
                    @foreach($categories as $catKey => $catLabel)
                    @if(isset($paymentMethods[$catKey]) && $paymentMethods[$catKey]->count() > 0)
                    <button class="pay-tab-btn {{ $firstCat ? 'active' : '' }}" onclick="switchPayTab('{{ $catKey }}', this)">{{ $catLabel }}</button>
                    @php $firstCat = false; @endphp
                    @endif
                    @endforeach
                </div>

                @php $firstCat2 = true; @endphp
                @foreach($categories as $catKey => $catLabel)
                @if(isset($paymentMethods[$catKey]) && $paymentMethods[$catKey]->count() > 0)
                <div class="payment-options {{ $firstCat2 ? 'active' : '' }}" id="pay-cat-{{ $catKey }}">
                    @php
                    $payLogos = [
                        'bca_va' => 'bca', 'bni_va' => 'bni', 'mandiri_va' => 'mandiri', 'bri_va' => 'bri',
                        'bsi_va' => 'bsi', 'cimb_va' => 'cimb', 'gopay' => 'gopay', 'ovo' => 'ovo',
                        'dana' => 'dana', 'shopeepay' => 'shopeepay', 'linkaja' => 'linkaja',
                        'qris' => 'qris', 'indomaret' => 'indomaret', 'alfamart' => 'alfamart',
                        'alfamidi' => 'alfamart', 'kredivo' => 'kredivo', 'akulaku' => 'akulaku',
                        'spaylater' => 'shopeepay',
                    ];
                    $icons = [
                        'bca_va' => '🔵', 'bni_va' => '🟠', 'mandiri_va' => '🟡', 'bri_va' => '🟢',
                        'bsi_va' => '🟢', 'cimb_va' => '🔴', 'gopay' => '💚', 'ovo' => '🟣',
                        'dana' => '🔵', 'shopeepay' => '🟠', 'linkaja' => '🔴', 'jenius' => '🔷',
                        'qris' => '📱', 'indomaret' => '🏪', 'alfamart' => '🏬', 'alfamidi' => '🏬',
                        'circlek' => '🏪', 'kredivo' => '🟤', 'akulaku' => '🟡', 'spaylater' => '🟠',
                    ];
                    @endphp
                    @foreach($paymentMethods[$catKey] as $pm)
                    @php
                        $logoFile = $payLogos[$pm->code] ?? null;
                        $logoPng = $logoFile ? public_path('images/payments/' . $logoFile . '.png') : null;
                        $logoSvg = $logoFile ? public_path('images/payments/' . $logoFile . '.svg') : null;
                        $logoUrl = $logoFile ? (file_exists($logoPng) ? asset('images/payments/' . $logoFile . '.png') : (file_exists($logoSvg) ? asset('images/payments/' . $logoFile . '.svg') : null)) : null;
                    @endphp
                    <div class="pay-option"
                         data-code="{{ $pm->code }}"
                         data-fee-flat="{{ $pm->fee_flat }}"
                         data-fee-pct="{{ $pm->fee_percent }}"
                         data-name="{{ $pm->name }}"
                         onclick="selectPayment(this)">
                        <span class="pay-option-icon">
                            @if($logoUrl)
                                <img src="{{ $logoUrl }}" alt="{{ $pm->name }}" style="width:44px;height:22px;object-fit:contain;border-radius:4px;">
                            @else
                                {{ $icons[$pm->code] ?? '💳' }}
                            @endif
                        </span>
                        <span class="pay-option-name">{{ $pm->name }}</span>
                        <span class="pay-option-fee">
                            @if($pm->fee_flat > 0) +Rp{{ number_format($pm->fee_flat, 0, ',', '.') }}
                            @elseif($pm->fee_percent > 0) +{{ $pm->fee_percent }}%
                            @else Gratis @endif
                        </span>
                    </div>
                    @endforeach
                </div>
                @php $firstCat2 = false; @endphp
                @endif
                @endforeach
            </div>

            <!-- STEP 4: BUYER INFO -->
            <div class="step-card" id="step4">
                <div class="step-header">
                    <div class="step-num">4</div>
                    <div>
                        <div class="step-title">Data Pembeli</div>
                        <div class="step-subtitle">Bukti pembayaran akan dikirim ke email ini</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span style="color: var(--secondary)">*</span></label>
                        <input type="text" class="form-control" id="buyerName" placeholder="Nama kamu" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email <span style="color: var(--secondary)">*</span></label>
                        <input type="email" class="form-control" id="buyerEmail" placeholder="email@example.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">No. WhatsApp (Opsional)</label>
                    <input type="text" class="form-control" id="buyerPhone" placeholder="08xxxxxxxxxx">
                </div>
            </div>
        </div>

        <!-- =================== RIGHT COLUMN (SUMMARY) =================== -->
        <div class="order-summary">
            <div class="summary-card">
                <div class="summary-header">
                    <i class="fas fa-receipt" style="color: var(--primary-light); margin-right: 8px;"></i>
                    Ringkasan Pesanan
                </div>
                <div class="summary-body">

                    <div class="summary-game">
                        <div class="summary-game-icon">
                            @if($gameImgUrl)
                                <img src="{{ $gameImgUrl }}" alt="{{ $game->name }}">
                            @else
                                {{ $emoji }}
                            @endif
                        </div>
                        <div>
                            <div class="summary-game-name">{{ $game->name }}</div>
                            <div class="summary-game-id" id="summaryUserId">ID: -</div>
                        </div>
                    </div>

                    <div id="summaryEmpty" class="empty-product-msg">
                        <i class="fas fa-hand-pointer" style="font-size: 2rem; margin-bottom: 0.5rem; display: block;"></i>
                        Pilih paket top up terlebih dahulu
                    </div>

                    <div id="summaryDetails" style="display: none;">
                        <div class="summary-row">
                            <span class="summary-label">Paket</span>
                            <span class="summary-value" id="summaryProduct">-</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Harga</span>
                            <span class="summary-value" id="summaryPrice">-</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Metode Bayar</span>
                            <span class="summary-value" id="summaryPayMethod">-</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Biaya Admin</span>
                            <span class="summary-value" id="summaryFee">Rp 0</span>
                        </div>
                        <hr class="summary-divider">
                        <div class="summary-total">
                            <span>Total Bayar</span>
                            <span class="summary-total-amount" id="summaryTotal">-</span>
                        </div>
                    </div>
                </div>

                <div class="summary-footer">
                    <button class="btn btn-primary btn-block btn-lg" id="btnCheckout" onclick="doCheckout()" disabled>
                        <i class="fas fa-bolt"></i> Lanjutkan Pembayaran
                    </button>
                    <div class="trust-badges">
                        <div class="trust-badge"><i class="fas fa-shield-alt" style="color: var(--accent)"></i> Aman</div>
                        <div class="trust-badge"><i class="fas fa-bolt" style="color: var(--gold)"></i> Instan</div>
                        <div class="trust-badge"><i class="fas fa-lock" style="color: var(--primary-light)"></i> Terenkripsi</div>
                        <div class="trust-badge"><i class="fas fa-undo" style="color: var(--secondary)"></i> Refund</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden inputs -->
<input type="hidden" id="selectedProductId">
<input type="hidden" id="selectedPaymentCode">
<input type="hidden" id="selectedPaymentFeeFlat">
<input type="hidden" id="selectedPaymentFeePct">

@endsection

@push('scripts')
<script>
    let selectedProduct = null;
    let selectedPayment = null;

    // =================== CHECK USER ===================
    function checkUser() {
        const userId = document.getElementById('gameUserId').value.trim();
        const resultEl = document.getElementById('userCheckResult');

        if (!userId) {
            showToast('Masukkan User ID terlebih dahulu', 'error');
            return;
        }

        const btn = document.querySelector('.input-group-btn');
        btn.innerHTML = '<div class="loading-spinner" style="width:16px;height:16px;border-width:2px;"></div>';
        btn.disabled = true;

        fetch('{{ route("topup.check-user") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ game_user_id: userId, game_server: document.getElementById('gameServer')?.value || '' }),
        })
        .then(r => r.json())
        .then(data => {
            resultEl.className = 'user-check-result ' + (data.success ? 'success' : 'error-msg');
            resultEl.innerHTML = data.success
                ? `<i class="fas fa-check-circle"></i> <strong>User ditemukan!</strong> Nickname: <strong>${data.username}</strong>`
                : `<i class="fas fa-times-circle"></i> ${data.message}`;

            // Update summary
            document.getElementById('summaryUserId').textContent = 'ID: ' + userId + (data.success ? ` (${data.username})` : '');
        })
        .catch(() => {
            resultEl.className = 'user-check-result error-msg';
            resultEl.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Terjadi kesalahan. Coba lagi.';
        })
        .finally(() => {
            btn.innerHTML = 'Cek ID';
            btn.disabled = false;
        });
    }

    function resetUserCheck() {
        const resultEl = document.getElementById('userCheckResult');
        resultEl.className = 'user-check-result';
        resultEl.style.display = 'none';
        document.getElementById('summaryUserId').textContent = 'ID: ' + (document.getElementById('gameUserId').value || '-');
    }

    // =================== SELECT PRODUCT ===================
    function selectProduct(el) {
        document.querySelectorAll('.product-item').forEach(p => p.classList.remove('selected'));
        el.classList.add('selected');

        selectedProduct = {
            id: el.dataset.id,
            name: el.dataset.name,
            price: parseFloat(el.dataset.price),
            original: parseFloat(el.dataset.original) || 0,
        };

        document.getElementById('selectedProductId').value = selectedProduct.id;
        updateSummary();
    }

    // =================== SELECT PAYMENT ===================
    function selectPayment(el) {
        document.querySelectorAll('.pay-option').forEach(p => p.classList.remove('selected'));
        el.classList.add('selected');

        selectedPayment = {
            code: el.dataset.code,
            name: el.dataset.name,
            feeFlat: parseFloat(el.dataset.feeFlat) || 0,
            feePct: parseFloat(el.dataset.feePct) || 0,
        };

        document.getElementById('selectedPaymentCode').value = selectedPayment.code;
        updateSummary();
    }

    // =================== SWITCH PAY TAB ===================
    function switchPayTab(catKey, btn) {
        document.querySelectorAll('.payment-options').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.pay-tab-btn').forEach(b => b.classList.remove('active'));

        document.getElementById('pay-cat-' + catKey)?.classList.add('active');
        btn.classList.add('active');

        // Clear payment selection when tab switches
        selectedPayment = null;
        document.querySelectorAll('.pay-option').forEach(p => p.classList.remove('selected'));
        document.getElementById('selectedPaymentCode').value = '';
        updateSummary();
    }

    // =================== UPDATE SUMMARY ===================
    function updateSummary() {
        if (!selectedProduct) return;

        document.getElementById('summaryEmpty').style.display = 'none';
        document.getElementById('summaryDetails').style.display = 'block';

        // User ID
        const userId = document.getElementById('gameUserId').value;
        document.getElementById('summaryUserId').textContent = 'ID: ' + (userId || '-');

        document.getElementById('summaryProduct').textContent = selectedProduct.name;
        document.getElementById('summaryPrice').textContent = 'Rp ' + selectedProduct.price.toLocaleString('id-ID');

        let fee = 0;
        if (selectedPayment) {
            document.getElementById('summaryPayMethod').textContent = selectedPayment.name;
            fee = selectedPayment.feeFlat + (selectedProduct.price * selectedPayment.feePct / 100);
        } else {
            document.getElementById('summaryPayMethod').textContent = '-';
        }

        document.getElementById('summaryFee').textContent = 'Rp ' + fee.toLocaleString('id-ID');
        document.getElementById('summaryTotal').textContent = 'Rp ' + (selectedProduct.price + fee).toLocaleString('id-ID');

        // Enable/disable checkout btn
        const canCheckout = selectedProduct && selectedPayment && document.getElementById('gameUserId').value.trim();
        document.getElementById('btnCheckout').disabled = !canCheckout;

        // Highlight active steps
        document.getElementById('step1').classList.toggle('active-step', true);
        document.getElementById('step2').classList.toggle('active-step', !!selectedProduct);
        document.getElementById('step3').classList.toggle('active-step', !!selectedPayment);
    }

    // Listen to user ID input
    document.getElementById('gameUserId').addEventListener('input', updateSummary);

    // =================== CHECKOUT ===================
    function doCheckout() {
        const userId = document.getElementById('gameUserId').value.trim();
        const buyerName = document.getElementById('buyerName').value.trim();
        const buyerEmail = document.getElementById('buyerEmail').value.trim();
        const buyerPhone = document.getElementById('buyerPhone').value.trim();

        if (!userId) { showToast('Masukkan User ID game', 'error'); return; }
        if (!selectedProduct) { showToast('Pilih paket top up terlebih dahulu', 'error'); return; }
        if (!selectedPayment) { showToast('Pilih metode pembayaran', 'error'); return; }
        if (!buyerName) { showToast('Masukkan nama lengkap', 'error'); return; }
        if (!buyerEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(buyerEmail)) { showToast('Masukkan email yang valid', 'error'); return; }

        const btn = document.getElementById('btnCheckout');
        btn.disabled = true;
        btn.innerHTML = '<div class="loading-spinner"></div> Memproses...';

        const server = document.getElementById('gameServer')?.value || '';

        fetch('{{ route("topup.checkout") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                product_id: selectedProduct.id,
                game_user_id: userId,
                game_server: server,
                buyer_name: buyerName,
                buyer_email: buyerEmail,
                buyer_phone: buyerPhone,
                payment_method: selectedPayment.code,
            }),
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast('Pesanan berhasil dibuat! Mengarahkan ke halaman pembayaran...', 'success');
                setTimeout(() => { window.location.href = data.redirect; }, 1200);
            } else {
                showToast(data.message || 'Terjadi kesalahan', 'error');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-bolt"></i> Lanjutkan Pembayaran';
            }
        })
        .catch(() => {
            showToast('Terjadi kesalahan jaringan. Coba lagi.', 'error');
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-bolt"></i> Lanjutkan Pembayaran';
        });
    }
</script>
@endpush
