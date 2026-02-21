@extends('layouts.app')

@section('title', 'PiannTopUp - Top Up Game Terpercaya, Murah & Cepat')

@push('styles')
<style>
    /* =================== HERO =================== */
    .hero {
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
        padding: 2rem 0;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }

    .hero-bg-gradient {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 80% 60% at 60% 40%, rgba(108,99,255,0.2) 0%, transparent 60%),
                    radial-gradient(ellipse 60% 50% at 20% 80%, rgba(255,101,132,0.15) 0%, transparent 55%),
                    var(--dark);
    }

    .hero-particles {
        position: absolute;
        inset: 0;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        border-radius: 50%;
        animation: float-particle linear infinite;
        opacity: 0;
    }

    @keyframes float-particle {
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
    }

    .hero-content {
        position: relative;
        z-index: 1;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .hero-left {}

    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: rgba(108,99,255,0.1);
        border: 1px solid rgba(108,99,255,0.3);
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--primary-light);
        margin-bottom: 1.5rem;
        animation: fadeInDown 0.6s ease;
    }

    .hero-tag .dot {
        width: 7px;
        height: 7px;
        background: var(--accent);
        border-radius: 50%;
        animation: pulse-dot 1.5s ease-in-out infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.5); opacity: 0.7; }
    }

    .hero-title {
        font-size: 3.8rem;
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.6s ease 0.1s both;
    }

    .hero-title .gradient-text {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-title .gradient-gold {
        background: var(--gradient-gold);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-desc {
        color: var(--text-secondary);
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 2rem;
        animation: fadeInUp 0.6s ease 0.2s both;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 3rem;
        animation: fadeInUp 0.6s ease 0.3s both;
    }

    .hero-stats {
        display: flex;
        gap: 2.5rem;
        animation: fadeInUp 0.6s ease 0.4s both;
    }

    .stat-item {}

    .stat-number {
        font-size: 1.8rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.8rem;
        margin-top: 4px;
    }

    .hero-right {
        position: relative;
        animation: fadeInRight 0.8s ease 0.2s both;
    }

    .hero-visual {
        position: relative;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .hero-game-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 16px;
        padding: 1.2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .hero-game-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--gradient-primary);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .hero-game-card:hover {
        transform: scale(1.05);
        border-color: var(--primary);
        box-shadow: 0 10px 30px rgba(108,99,255,0.3);
    }

    .hero-game-card:hover::before { opacity: 0.05; }

    .hero-game-card.featured {
        grid-column: span 2;
        padding: 1.5rem;
    }

    .hgc-emoji {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .hero-game-card.featured .hgc-emoji { font-size: 3rem; }

    .hgc-name {
        font-weight: 700;
        font-size: 0.85rem;
        color: white;
        position: relative;
        z-index: 1;
    }

    .hero-game-card.featured .hgc-name { font-size: 1rem; }

    .hgc-price {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 2px;
        position: relative;
        z-index: 1;
    }

    .floating-badge {
        position: absolute;
        top: -10px;
        right: -10px;
        background: var(--gradient-primary);
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 20px;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(108,99,255,0.5);
    }

    .hero-glow-effect {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(108,99,255,0.2) 0%, transparent 70%);
        pointer-events: none;
        animation: breathe 3s ease-in-out infinite;
    }

    @keyframes breathe {
        0%, 100% { transform: translate(-50%, -50%) scale(1); }
        50% { transform: translate(-50%, -50%) scale(1.1); }
    }

    .hero-search {
        margin-bottom: 2.5rem;
        animation: fadeInUp 0.6s ease 0.25s both;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 0;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 14px;
        overflow: hidden;
        transition: border-color 0.3s ease;
        max-width: 480px;
    }

    .search-box:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(108,99,255,0.15);
    }

    .search-box i {
        padding: 0 1rem;
        color: var(--text-muted);
        font-size: 1rem;
    }

    .search-box input {
        flex: 1;
        background: transparent;
        border: none;
        outline: none;
        padding: 14px 0;
        color: white;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
    }

    .search-box input::placeholder { color: var(--text-muted); }

    .search-box button {
        padding: 0 1.2rem;
        height: 100%;
        background: var(--gradient-primary);
        border: none;
        color: white;
        font-size: 0.9rem;
        cursor: pointer;
        font-weight: 600;
        transition: opacity 0.3s;
        font-family: 'Inter', sans-serif;
        margin: 6px;
        border-radius: 9px;
    }

    .search-box button:hover { opacity: 0.9; }

    /* =================== FEATURES =================== */
    .features-section {
        background: var(--dark-card);
        border-top: 1px solid var(--dark-border);
        border-bottom: 1px solid var(--dark-border);
        padding: 3rem 0;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .feature-icon.purple { background: rgba(108,99,255,0.15); color: var(--primary-light); }
    .feature-icon.green { background: rgba(67,233,123,0.12); color: var(--accent); }
    .feature-icon.gold { background: rgba(255,215,0,0.1); color: var(--gold); }
    .feature-icon.pink { background: rgba(255,101,132,0.12); color: var(--secondary); }

    .feature-title {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 4px;
    }

    .feature-desc {
        color: var(--text-muted);
        font-size: 0.82rem;
        line-height: 1.5;
    }

    /* =================== GAMES GRID =================== */
    .games-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1.2rem;
    }

    .game-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: block;
        position: relative;
    }

    .game-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--gradient-primary);
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 15px;
    }

    .game-card:hover {
        transform: translateY(-6px);
        border-color: rgba(108,99,255,0.6);
        box-shadow: 0 12px 35px rgba(108,99,255,0.25);
    }

    .game-card:hover::after { opacity: 0.03; }

    .game-card-image {
        width: 100%;
        aspect-ratio: 4/3;
        background: var(--dark-card2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        position: relative;
        overflow: hidden;
    }

    .game-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .game-card:hover .game-card-image img {
        transform: scale(1.08);
    }

    .game-card-image .emoji-fallback {
        font-size: 3.5rem;
        position: relative;
        z-index: 1;
    }

    .game-card-image::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, var(--dark-card), transparent);
        z-index: 2;
    }

    .game-card-body {
        padding: 1rem;
    }

    .game-card-name {
        font-weight: 700;
        font-size: 0.9rem;
        color: white;
        margin-bottom: 0.3rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .game-card-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .game-card-cat {
        font-size: 0.73rem;
        color: var(--text-muted);
    }

    .game-card-from {
        font-size: 0.73rem;
        color: var(--accent);
        font-weight: 600;
    }

    .game-card-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 2;
    }

    /* Tab filters */
    .tab-filters {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .tab-btn {
        padding: 8px 20px;
        border-radius: 30px;
        border: 1px solid var(--dark-border);
        background: transparent;
        color: var(--text-secondary);
        font-size: 0.85rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
    }

    .tab-btn.active, .tab-btn:hover {
        background: var(--gradient-primary);
        border-color: transparent;
        color: white;
    }

    /* =================== HOW TO =================== */
    .howto-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        position: relative;
    }

    .howto-grid::before {
        content: '';
        position: absolute;
        top: 35px;
        left: 10%;
        right: 10%;
        height: 2px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        opacity: 0.3;
    }

    .howto-item {
        text-align: center;
        padding: 2rem 1.5rem;
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 16px;
        transition: all 0.3s ease;
        position: relative;
    }

    .howto-item:hover {
        border-color: rgba(108,99,255,0.4);
        transform: translateY(-4px);
    }

    .howto-number {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        font-weight: 900;
        margin: 0 auto 1.2rem;
        box-shadow: 0 4px 20px rgba(108,99,255,0.4);
        position: relative;
        z-index: 1;
        color: white;
    }

    .howto-icon { font-size: 1.3rem; }

    .howto-title {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .howto-desc {
        color: var(--text-muted);
        font-size: 0.85rem;
        line-height: 1.6;
    }

    /* =================== PAYMENT SECTION =================== */
    .payment-logos {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
        margin-top: 2rem;
    }

    .payment-cat-title {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1rem;
    }

    .payment-methods-wrapper {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .payment-cat {}

    .payment-method-list {
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
    }

    .payment-method-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        background: var(--dark-card2);
        border: 1px solid var(--dark-border);
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .payment-method-item:hover {
        border-color: rgba(108,99,255,0.4);
        background: rgba(108,99,255,0.07);
        transform: translateX(3px);
    }

    .pmi-icon {
        width: 56px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        background: rgba(255,255,255,0.08);
        overflow: hidden;
        flex-shrink: 0;
    }

    .pmi-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }

    /* =================== TESTIMONIALS =================== */
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .testi-card {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 16px;
        padding: 1.8rem;
        transition: all 0.3s ease;
    }

    .testi-card:hover {
        border-color: rgba(108,99,255,0.4);
        transform: translateY(-4px);
    }

    .testi-stars {
        color: var(--gold);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .testi-text {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 1.2rem;
        font-style: italic;
    }

    .testi-user {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .testi-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .testi-name { font-weight: 700; font-size: 0.9rem; }
    .testi-meta { color: var(--text-muted); font-size: 0.78rem; }

    /* =================== FAQ =================== */
    .faq-list {
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .faq-item {
        background: var(--dark-card);
        border: 1px solid var(--dark-border);
        border-radius: 14px;
        overflow: hidden;
        transition: border-color 0.3s ease;
    }

    .faq-item.open { border-color: rgba(108,99,255,0.4); }

    .faq-question {
        padding: 1.2rem 1.5rem;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        transition: color 0.3s ease;
        user-select: none;
    }

    .faq-question:hover { color: var(--primary-light); }

    .faq-arrow {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--dark-card2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
        transition: all 0.3s ease;
        color: var(--text-secondary);
    }

    .faq-item.open .faq-arrow {
        background: var(--primary);
        color: white;
        transform: rotate(180deg);
    }

    .faq-answer {
        padding: 0 1.5rem;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease, padding 0.35s ease;
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.7;
    }

    .faq-item.open .faq-answer {
        max-height: 300px;
        padding: 0 1.5rem 1.2rem;
    }

    /* =================== CTA =================== */
    .cta-section {
        background: var(--dark-card);
        border-top: 1px solid var(--dark-border);
        border-bottom: 1px solid var(--dark-border);
        padding: 5rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        height: 300px;
        background: radial-gradient(ellipse, rgba(108,99,255,0.15) 0%, transparent 70%);
        pointer-events: none;
    }

    .cta-title {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .cta-desc {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }

    /* =================== ANIMATIONS =================== */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* REVEAL ON SCROLL */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* =================== RESPONSIVE =================== */
    @media (max-width: 1200px) {
        .games-grid { grid-template-columns: repeat(4, 1fr); }
        .features-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 1024px) {
        .hero-content { grid-template-columns: 1fr; gap: 3rem; }
        .hero-right { display: none; }
        .hero-title { font-size: 2.8rem; }
        .howto-grid { grid-template-columns: repeat(2, 1fr); }
        .payment-methods-wrapper { grid-template-columns: repeat(2, 1fr); }
        .testimonials-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 2.2rem; }
        .hero-stats { gap: 1.5rem; }
        .games-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        .features-grid { grid-template-columns: 1fr; gap: 1.5rem; }
        .howto-grid { grid-template-columns: 1fr; }
        .howto-grid::before { display: none; }
        .payment-methods-wrapper { grid-template-columns: 1fr; }
        .testimonials-grid { grid-template-columns: 1fr; }
        .cta-title { font-size: 1.8rem; }
    }

    @media (max-width: 480px) {
        .games-grid { grid-template-columns: repeat(2, 1fr); }
        .hero-title { font-size: 1.9rem; }
    }
</style>
@endpush

@section('content')

<!-- =================== HERO =================== -->
<section class="hero">
    <div class="hero-bg">
        <div class="hero-bg-gradient"></div>
        <div class="hero-particles" id="particlesContainer"></div>
    </div>

    <div class="hero-content">
        <div class="hero-left">
            <div class="hero-tag">
                <span class="dot"></span>
                ⚡ Platform Top Up #1 Indonesia
            </div>

            <h1 class="hero-title">
                Top Up Game<br>
                <span class="gradient-text">Terpercaya</span> &<br>
                <span class="gradient-gold">Super Murah</span>
            </h1>

            <p class="hero-desc">
                Nikmati kemudahan top up 100+ game populer dengan harga terjangkau, proses otomatis, dan dukungan semua metode pembayaran Indonesia.
            </p>

            <div class="hero-search">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="heroSearch" placeholder="Cari game favorit kamu..." autocomplete="off">
                    <button onclick="performSearch()">Cari</button>
                </div>
            </div>

            <div class="hero-actions">
                <a href="#games" class="btn btn-primary btn-lg">
                    <i class="fas fa-gamepad"></i> Top Up Sekarang
                </a>
                <a href="{{ route('order.track') }}" class="btn btn-outline btn-lg">
                    <i class="fas fa-receipt"></i> Cek Pesanan
                </a>
            </div>

            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">Game Tersedia</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ number_format($totalOrders > 0 ? $totalOrders : 50000, 0, ',', '.') }}+</div>
                    <div class="stat-label">Transaksi Sukses</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Layanan Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Metode Bayar</div>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <div class="hero-glow-effect"></div>
            <div class="hero-visual">
                <div class="hero-game-card featured" onclick="location.href='{{ !$featuredGames->isEmpty() ? route('topup.show', $featuredGames->first()) : '#' }}'">
                    <span class="floating-badge">🔥 TERPOPULER</span>
                    <div class="hgc-emoji">⚔️</div>
                    <div class="hgc-name">Mobile Legends</div>
                    <div class="hgc-price">Mulai Rp 3.000</div>
                </div>
                <div class="hero-game-card" onclick="location.href='{{ route('topup.show', ['game' => 'pubg-mobile']) }}'">
                    <div class="hgc-emoji">🎯</div>
                    <div class="hgc-name">PUBG Mobile</div>
                    <div class="hgc-price">Mulai Rp 15.000</div>
                </div>
                <div class="hero-game-card" onclick="location.href='{{ route('topup.show', ['game' => 'free-fire']) }}'">
                    <div class="hgc-emoji">🔥</div>
                    <div class="hgc-name">Free Fire</div>
                    <div class="hgc-price">Mulai Rp 8.000</div>
                </div>
                <div class="hero-game-card" onclick="location.href='{{ route('topup.show', ['game' => 'genshin-impact']) }}'">
                    <div class="hgc-emoji">🌟</div>
                    <div class="hgc-name">Genshin Impact</div>
                    <div class="hgc-price">Mulai Rp 15.000</div>
                </div>
                <div class="hero-game-card" onclick="location.href='{{ route('topup.show', ['game' => 'valorant']) }}'">
                    <div class="hgc-emoji">💥</div>
                    <div class="hgc-name">Valorant</div>
                    <div class="hgc-price">Mulai Rp 70.000</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =================== FEATURES =================== -->
<section class="features-section">
    <div class="container">
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon purple"><i class="fas fa-bolt"></i></div>
                <div>
                    <div class="feature-title">Proses Otomatis</div>
                    <div class="feature-desc">Top up langsung diproses otomatis tanpa manual, cepat & andal</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon green"><i class="fas fa-shield-alt"></i></div>
                <div>
                    <div class="feature-title">Aman & Terpercaya</div>
                    <div class="feature-desc">Transaksi terenkripsi, data aman, refund terjamin jika gagal</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon gold"><i class="fas fa-tags"></i></div>
                <div>
                    <div class="feature-title">Harga Terbaik</div>
                    <div class="feature-desc">Harga kompetitif, promo menarik, dan diskon member setia</div>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-icon pink"><i class="fas fa-headset"></i></div>
                <div>
                    <div class="feature-title">Support 24/7</div>
                    <div class="feature-desc">Tim CS siap membantu Anda kapanpun via WhatsApp & Live Chat</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =================== ALL GAMES =================== -->
<section id="games" class="section">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-tag"><i class="fas fa-gamepad"></i> Game Library</div>
            <h2 class="section-title">Pilih <span>Game Favoritmu</span></h2>
            <p class="section-subtitle">Top up 100+ game populer dengan proses cepat dan harga terjangkau</p>
        </div>

        <div class="tab-filters reveal">
            <button class="tab-btn active" onclick="filterGames('all', this)">🎮 Semua Game</button>
            <button class="tab-btn" onclick="filterGames('mobile', this)">📱 Mobile</button>
            <button class="tab-btn" onclick="filterGames('pc', this)">💻 PC / Console</button>
        </div>

        <div class="games-grid" id="gamesGrid">
            @foreach($allGames as $game)
            @php
                $emojis = [
                    'mobile-legends' => '⚔️',
                    'pubg-mobile' => '🎯',
                    'free-fire' => '🔥',
                    'genshin-impact' => '🌟',
                    'honkai-star-rail' => '🚀',
                    'valorant' => '💥',
                    'roblox' => '🧱',
                    'league-of-legends' => '🏆',
                    'arena-of-valor' => '🛡️',
                    'minecraft' => '⛏️',
                ];
                $emoji = $emojis[$game->slug] ?? '🎮';
                $minPrice = $game->products->min('price');
                // Gunakan gambar PNG langsung
                $gameImgUrl = asset('images/games/' . $game->slug . '.png');
            @endphp
            <a href="{{ route('topup.show', $game) }}"
               class="game-card"
               data-category="{{ $game->category }}"
               data-name="{{ strtolower($game->name) }}">
                @if($game->is_featured)
                <span class="game-card-badge"><span class="badge badge-hot">⭐ Featured</span></span>
                @endif
                <div class="game-card-image">
                    <img src="{{ $gameImgUrl }}" alt="{{ $game->name }}" loading="lazy" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <span class="emoji-fallback" style="display:none;">{{ $emoji }}</span>
                </div>
                <div class="game-card-body">
                    <div class="game-card-name">{{ $game->name }}</div>
                    <div class="game-card-meta">
                        <span class="game-card-cat">{{ ucfirst($game->category) }}</span>
                        <span class="game-card-from">Rp {{ number_format($minPrice, 0, ',', '.') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- =================== HOW TO =================== -->
<section class="section" style="background: var(--dark-card); border-top: 1px solid var(--dark-border); border-bottom: 1px solid var(--dark-border);">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-tag"><i class="fas fa-list-ol"></i> Cara Top Up</div>
            <h2 class="section-title">Hanya <span>4 Langkah</span> Mudah</h2>
            <p class="section-subtitle">Top up game favoritmu dengan cara yang simpel dan cepat</p>
        </div>

        <div class="howto-grid reveal">
            <div class="howto-item">
                <div class="howto-number"><span class="howto-icon">🎮</span></div>
                <div class="howto-title">Pilih Game</div>
                <p class="howto-desc">Cari dan pilih game yang ingin kamu top up dari 100+ pilihan game</p>
            </div>
            <div class="howto-item">
                <div class="howto-number"><span class="howto-icon">📝</span></div>
                <div class="howto-title">Isi ID & Nominal</div>
                <p class="howto-desc">Masukkan ID akun game dan pilih nominal yang ingin dibeli</p>
            </div>
            <div class="howto-item">
                <div class="howto-number"><span class="howto-icon">💳</span></div>
                <div class="howto-title">Pilih Pembayaran</div>
                <p class="howto-desc">Bayar dengan 20+ metode: transfer bank, e-wallet, QRIS, minimarket</p>
            </div>
            <div class="howto-item">
                <div class="howto-number"><span class="howto-icon">✅</span></div>
                <div class="howto-title">Top Up Masuk!</div>
                <p class="howto-desc">Setelah pembayaran terkonfirmasi, item langsung masuk ke akun</p>
            </div>
        </div>
    </div>
</section>

<!-- =================== PAYMENT METHODS =================== -->
<section class="section" id="payment">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-tag"><i class="fas fa-credit-card"></i> Metode Bayar</div>
            <h2 class="section-title">Semua <span>Metode Pembayaran</span></h2>
            <p class="section-subtitle">Bayar dengan cara apapun yang kamu suka, kami dukung semua!</p>
        </div>

        <div class="payment-methods-wrapper reveal">
            <div class="payment-cat">
                <div class="payment-cat-title">🏦 Bank Transfer</div>
                <div class="payment-method-list">
                    @php
                    $banks = [
                        ['logo' => 'bca', 'name' => 'BCA Virtual Account'],
                        ['logo' => 'bni', 'name' => 'BNI Virtual Account'],
                        ['logo' => 'mandiri', 'name' => 'Mandiri Virtual Account'],
                        ['logo' => 'bri', 'name' => 'BRI Virtual Account'],
                        ['logo' => 'bsi', 'name' => 'BSI Virtual Account'],
                        ['logo' => 'cimb', 'name' => 'CIMB Niaga VA'],
                    ];
                    @endphp
                    @foreach($banks as $bank)
                    @php
                        $logoPng = public_path('images/payments/' . $bank['logo'] . '.png');
                        $logoSvg = public_path('images/payments/' . $bank['logo'] . '.svg');
                        $logoUrl = file_exists($logoPng) ? asset('images/payments/' . $bank['logo'] . '.png') : (file_exists($logoSvg) ? asset('images/payments/' . $bank['logo'] . '.svg') : null);
                    @endphp
                    <div class="payment-method-item">
                        <div class="pmi-icon">
                            @if($logoUrl)
                                <img src="{{ $logoUrl }}" alt="{{ $bank['name'] }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <span style="font-size: 0.8rem;">{{ $bank['name'] }}</span>
                            @endif
                        </div>
                        {{ $bank['name'] }}
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="payment-cat">
                <div class="payment-cat-title">📱 E-Wallet</div>
                <div class="payment-method-list">
                    @php
                    $wallets = [
                        ['logo' => 'gopay', 'name' => 'GoPay'],
                        ['logo' => 'ovo', 'name' => 'OVO'],
                        ['logo' => 'dana', 'name' => 'DANA'],
                        ['logo' => 'shopeepay', 'name' => 'ShopeePay'],
                        ['logo' => 'linkaja', 'name' => 'LinkAja'],
                    ];
                    @endphp
                    @foreach($wallets as $wallet)
                    @php
                        $logoPng = public_path('images/payments/' . $wallet['logo'] . '.png');
                        $logoSvg = public_path('images/payments/' . $wallet['logo'] . '.svg');
                        $logoUrl = file_exists($logoPng) ? asset('images/payments/' . $wallet['logo'] . '.png') : (file_exists($logoSvg) ? asset('images/payments/' . $wallet['logo'] . '.svg') : null);
                    @endphp
                    <div class="payment-method-item">
                        <div class="pmi-icon">
                            @if($logoUrl)
                                <img src="{{ $logoUrl }}" alt="{{ $wallet['name'] }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <span style="font-size: 0.8rem;">{{ $wallet['name'] }}</span>
                            @endif
                        </div>
                        {{ $wallet['name'] }}
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="payment-cat">
                <div class="payment-cat-title">📲 QRIS & Minimarket</div>
                <div class="payment-method-list">
                    @php
                        $qrisPng = public_path('images/payments/qris.png');
                        $qrisSvg = public_path('images/payments/qris.svg');
                        $qrisUrl = file_exists($qrisPng) ? asset('images/payments/qris.png') : (file_exists($qrisSvg) ? asset('images/payments/qris.svg') : null);
                        $indomaretPng = public_path('images/payments/indomaret.png');
                        $indomaretSvg = public_path('images/payments/indomaret.svg');
                        $indomaretUrl = file_exists($indomaretPng) ? asset('images/payments/indomaret.png') : (file_exists($indomaretSvg) ? asset('images/payments/indomaret.svg') : null);
                        $alfamartPng = public_path('images/payments/alfamart.png');
                        $alfamartSvg = public_path('images/payments/alfamart.svg');
                        $alfamartUrl = file_exists($alfamartPng) ? asset('images/payments/alfamart.png') : (file_exists($alfamartSvg) ? asset('images/payments/alfamart.svg') : null);
                    @endphp
                    <div class="payment-method-item">
                        <div class="pmi-icon">
                            @if($qrisUrl)
                                <img src="{{ $qrisUrl }}" alt="QRIS" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <span style="font-size: 0.7rem;">QRIS</span>
                            @endif
                        </div>
                        QRIS (Semua Bank & E-Wallet)
                    </div>
                    <div class="payment-method-item">
                        <div class="pmi-icon">
                            @if($indomaretUrl)
                                <img src="{{ $indomaretUrl }}" alt="Indomaret" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <span style="font-size: 0.7rem;">INDO</span>
                            @endif
                        </div>
                        Indomaret
                    </div>
                    <div class="payment-method-item">
                        <div class="pmi-icon">
                            @if($alfamartUrl)
                                <img src="{{ $alfamartUrl }}" alt="Alfamart" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <span style="font-size: 0.7rem;">ALFA</span>
                            @endif
                        </div>
                        Alfamart
                    </div>
                    <div class="payment-method-item">
                        <div class="pmi-icon">
                            @if($alfamartUrl)
                                <img src="{{ $alfamartUrl }}" alt="Alfamidi" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <span style="font-size: 0.7rem;">MIDI</span>
                            @endif
                        </div>
                        Alfamidi
                    </div>
                    <div class="payment-method-item">
                        <div class="pmi-icon" style="font-size:1rem;background:rgba(0,120,60,0.3);">🏪</div>
                        Circle K
                    </div>
                </div>
            </div>

            <div class="payment-cat">
                <div class="payment-cat-title">💸 Paylater</div>
                <div class="payment-method-list">
                    @php
                        $kredivoPng = public_path('images/payments/kredivo.png');
                        $kredivoSvg = public_path('images/payments/kredivo.svg');
                        $kredivoUrl = file_exists($kredivoPng) ? asset('images/payments/kredivo.png') : (file_exists($kredivoSvg) ? asset('images/payments/kredivo.svg') : null);
                        $akulakuPng = public_path('images/payments/akulaku.png');
                        $akulakuSvg = public_path('images/payments/akulaku.svg');
                        $akulakuUrl = file_exists($akulakuPng) ? asset('images/payments/akulaku.png') : (file_exists($akulakuSvg) ? asset('images/payments/akulaku.svg') : null);
                        $shopeepayPng = public_path('images/payments/shopeepay.png');
                        $shopeepaySvg = public_path('images/payments/shopeepay.svg');
                        $shopeepayUrl = file_exists($shopeepayPng) ? asset('images/payments/shopeepay.png') : (file_exists($shopeepaySvg) ? asset('images/payments/shopeepay.svg') : null);
                    @endphp
                    <div class="payment-method-item">
                        <div class="pmi-icon">
                            @if($kredivoUrl)
                                <img src="{{ $kredivoUrl }}" alt="Kredivo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <span style="font-size: 0.7rem;">KRED</span>
                            @endif
                        </div>
                        Kredivo
                    </div>
                    <div class="payment-method-item">
                        <div class="pmi-icon">
                            @if($akulakuUrl)
                                <img src="{{ $akulakuUrl }}" alt="Akulaku" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <span style="font-size: 0.7rem;">AKUL</span>
                            @endif
                        </div>
                        Akulaku
                    </div>
                    <div class="payment-method-item">
                        <div class="pmi-icon">
                            @if($shopeepayUrl)
                                <img src="{{ $shopeepayUrl }}" alt="SPayLater" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <span style="font-size: 0.7rem;">SPAY</span>
                            @endif
                        </div>
                        PayLater by Shopee
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =================== TESTIMONIALS =================== -->
<section class="section" style="background: var(--dark-card); border-top: 1px solid var(--dark-border); border-bottom: 1px solid var(--dark-border);">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-tag"><i class="fas fa-star"></i> Testimoni</div>
            <h2 class="section-title">Apa Kata <span>Pelanggan Kami</span></h2>
            <p class="section-subtitle">Bergabung dengan ribuan gamer yang sudah mempercayai PiannTopUp</p>
        </div>
        <div class="testimonials-grid reveal">
            @php
            $testimonials = [
                ['name' => 'Andi Pramudya', 'game' => 'Mobile Legends Player', 'avatar' => 'AP', 'color' => '#6c63ff', 'rating' => 5, 'text' => 'Mantap banget! Top up diamond ML-ku langsung masuk dalam hitungan detik. Harga juga paling murah dibanding toko lain. Udah jadi langganan!'],
                ['name' => 'Siska Rahayu', 'game' => 'Free Fire Player', 'avatar' => 'SR', 'color' => '#ff6584', 'rating' => 5, 'text' => 'Awalnya ragu, tapi ternyata aman banget! Diamond langsung masuk setelah bayar pakai GoPay. Prosesnya cepet banget, ga sampai semenit!'],
                ['name' => 'Budi Santoso', 'game' => 'PUBG Mobile Player', 'avatar' => 'BS', 'color' => '#43e97b', 'rating' => 5, 'text' => 'Top up UC PUBG-nya gampang banget. Tinggal masukin ID, pilih jumlah, bayar, selesai! Customer service-nya juga responsif. Recommended!'],
                ['name' => 'Reza Firmansyah', 'game' => 'Genshin Impact Player', 'avatar' => 'RF', 'color' => '#ffd700', 'rating' => 5, 'text' => 'PiannTopUp terbaik! Crystal Genshin langsung masuk, harga lebih murah dari toko resmi. Pake QRIS juga bisa. Pasti balik lagi!'],
                ['name' => 'Dewi Kusuma', 'game' => 'Mobile Legends Player', 'avatar' => 'DK', 'color' => '#f093fb', 'rating' => 5, 'text' => 'Sudah pakai PiannTopUp lebih dari setahun. Selalu aman, cepat, dan terpercaya. Wajib cobain kalau belum pernah!'],
                ['name' => 'Kevin Halim', 'game' => 'Valorant Player', 'avatar' => 'KH', 'color' => '#38f9d7', 'rating' => 5, 'text' => 'VP Valorant-ku langsung masuk! Harga lebih murah dan prosesnya kilat. Bayar pake OVO juga bisa. Super rekomen!'],
            ];
            @endphp

            @foreach($testimonials as $t)
            <div class="testi-card">
                <div class="testi-stars">
                    @for($i = 0; $i < $t['rating']; $i++) <i class="fas fa-star"></i>@endfor
                </div>
                <p class="testi-text">"{{ $t['text'] }}"</p>
                <div class="testi-user">
                    <div class="testi-avatar" style="background: {{ $t['color'] }}22; color: {{ $t['color'] }}">{{ $t['avatar'] }}</div>
                    <div>
                        <div class="testi-name">{{ $t['name'] }}</div>
                        <div class="testi-meta">{{ $t['game'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =================== FAQ =================== -->
<section id="faq" class="section">
    <div class="container">
        <div class="section-header reveal">
            <div class="section-tag"><i class="fas fa-question-circle"></i> FAQ</div>
            <h2 class="section-title">Pertanyaan <span>Umum</span></h2>
            <p class="section-subtitle">Temukan jawaban atas pertanyaan yang sering ditanyakan</p>
        </div>

        <div class="faq-list reveal">
            @php
            $faqs = [
                ['q' => 'Berapa lama proses top up setelah pembayaran?', 'a' => 'Proses top up berlangsung otomatis dan instan setelah pembayaran terkonfirmasi. Biasanya item masuk dalam 1-5 menit. Jika lebih dari 15 menit, segera hubungi CS kami.'],
                ['q' => 'Apa saja metode pembayaran yang tersedia?', 'a' => 'Kami mendukung 20+ metode pembayaran: Transfer Bank (BCA, BNI, Mandiri, BRI), E-Wallet (GoPay, OVO, DANA, ShopeePay), QRIS, Minimarket (Indomaret, Alfamart), dan Paylater (Kredivo, Akulaku).'],
                ['q' => 'Bagaimana cara memasukkan ID game yang benar?', 'a' => 'Cara mencari ID game berbeda untuk setiap game. Di halaman top up setiap game, kami menyediakan panduan cara menemukan ID akun game Anda. Pastikan ID yang dimasukkan sudah benar sebelum melanjutkan.'],
                ['q' => 'Apakah ada jaminan keamanan transaksi?', 'a' => 'Ya! Semua transaksi di PiannTopUp dienkripsi dengan SSL dan aman. Kami tidak menyimpan data pembayaran Anda. Jika ada masalah, kami jamin refund sepenuhnya dalam 1x24 jam kerja.'],
                ['q' => 'Apa yang harus dilakukan jika top up gagal?', 'a' => 'Jangan khawatir! Jika top up gagal setelah pembayaran berhasil, saldo akan dikembalikan atau diproses ulang dalam 1x24 jam. Anda bisa melacak status pesanan di menu "Cek Pesanan" atau hubungi CS kami.'],
                ['q' => 'Apakah bisa top up tanpa registrasi/akun?', 'a' => 'Ya! Anda bisa melakukan top up tanpa perlu registrasi. Cukup masukkan ID game, isi data pembayaran, dan selesai. Pastikan email yang dimasukkan valid untuk menerima bukti transaksi.'],
            ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div class="faq-item" id="faq-{{ $i }}">
                <div class="faq-question" onclick="toggleFaq({{ $i }})">
                    <span>{{ $faq['q'] }}</span>
                    <span class="faq-arrow"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">{{ $faq['a'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- =================== CTA =================== -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">
            Siap Top Up Game Sekarang? <span style="background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">⚡</span>
        </h2>
        <p class="cta-desc">Bergabung dengan 50.000+ gamer yang sudah mempercayai PiannTopUp</p>
        <a href="#games" class="btn btn-primary btn-lg">
            <i class="fas fa-gamepad"></i> Mulai Top Up
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // =================== PARTICLES ===================
    (function createParticles() {
        const container = document.getElementById('particlesContainer');
        const colors = ['#6c63ff', '#ff6584', '#43e97b', '#ffd700', '#38f9d7'];
        for (let i = 0; i < 25; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            const size = Math.random() * 6 + 2;
            p.style.cssText = `
                width: ${size}px; height: ${size}px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                left: ${Math.random() * 100}%;
                animation-duration: ${Math.random() * 15 + 10}s;
                animation-delay: ${Math.random() * 10}s;
            `;
            container.appendChild(p);
        }
    })();

    // =================== REVEAL ON SCROLL ===================
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) e.target.classList.add('visible');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    // =================== FILTER GAMES ===================
    function filterGames(category, btn) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.game-card').forEach(card => {
            if (category === 'all' || card.dataset.category === category) {
                card.style.display = 'block';
                card.style.animation = 'fadeInUp 0.3s ease';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // =================== SEARCH ===================
    function performSearch() {
        const query = document.getElementById('heroSearch').value.toLowerCase().trim();
        if (!query) return;

        const cards = document.querySelectorAll('.game-card');
        let found = false;
        document.getElementById('games').scrollIntoView({ behavior: 'smooth' });

        setTimeout(() => {
            cards.forEach(card => {
                const name = card.dataset.name;
                if (name && name.includes(query)) {
                    card.style.display = 'block';
                    found = true;
                } else {
                    card.style.display = 'none';
                }
            });

            if (!found) {
                showToast('Game tidak ditemukan. Coba kata kunci lain.', 'error');
                cards.forEach(card => card.style.display = 'block');
            } else {
                showToast(`Menampilkan hasil untuk "${query}"`, 'success');
            }
        }, 500);

        // Reset tab filters
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-btn')[0].classList.add('active');
    }

    document.getElementById('heroSearch').addEventListener('keypress', (e) => {
        if (e.key === 'Enter') performSearch();
    });

    // =================== FAQ ===================
    function toggleFaq(id) {
        const item = document.getElementById(`faq-${id}`);
        const isOpen = item.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
        if (!isOpen) item.classList.add('open');
    }
</script>
@endpush
