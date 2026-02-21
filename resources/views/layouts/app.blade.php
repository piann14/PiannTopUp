<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PiannTopUp - Top Up Game Terpercaya, Cepat & Murah. Mobile Legends, PUBG, Free Fire, Genshin Impact dan 100+ game lainnya.">
    <meta name="keywords" content="top up game, diamond mobile legends, UC PUBG, voucher game, top up murah">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PiannTopUp - Top Up Game Terpercaya & Murah')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --primary: #6c63ff;
            --primary-dark: #5a52d5;
            --primary-light: #8a83ff;
            --secondary: #ff6584;
            --accent: #43e97b;
            --accent-blue: #38f9d7;
            --gold: #ffd700;
            --dark: #0d0d1a;
            --dark-card: #13132a;
            --dark-card2: #1a1a35;
            --dark-border: #252545;
            --text-primary: #ffffff;
            --text-secondary: #9999cc;
            --text-muted: #6666aa;
            --gradient-primary: linear-gradient(135deg, #6c63ff 0%, #ff6584 100%);
            --gradient-gold: linear-gradient(135deg, #f093fb 0%, #f5a623 100%);
            --gradient-green: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --gradient-dark: linear-gradient(180deg, #0d0d1a 0%, #13132a 100%);
            --shadow-glow: 0 0 30px rgba(108, 99, 255, 0.3);
            --shadow-card: 0 8px 32px rgba(0,0,0,0.4);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* =================== SCROLLBAR =================== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark); }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 3px; }

        /* =================== NAVBAR =================== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(13, 13, 26, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(108, 99, 255, 0.2);
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(13, 13, 26, 0.98);
            box-shadow: 0 4px 20px rgba(108, 99, 255, 0.2);
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 900;
            box-shadow: var(--shadow-glow);
        }

        .logo-text {
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }

        .navbar-menu a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .navbar-menu a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gradient-primary);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .navbar-menu a:hover { color: var(--text-primary); }
        .navbar-menu a:hover::after { width: 100%; }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-nav-cek {
            padding: 8px 18px;
            border-radius: 8px;
            border: 1px solid rgba(108,99,255,0.5);
            background: transparent;
            color: var(--primary-light);
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-nav-cek:hover {
            background: rgba(108,99,255,0.15);
            border-color: var(--primary);
            color: white;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 5px;
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--text-secondary);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: rgba(13,13,26,0.98);
            backdrop-filter: blur(20px);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--dark-border);
            flex-direction: column;
            gap: 1rem;
            z-index: 999;
        }

        .mobile-menu.open { display: flex; }

        .mobile-menu a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--dark-border);
            transition: color 0.3s ease;
        }

        .mobile-menu a:hover { color: white; }

        /* =================== MAIN CONTENT =================== */
        .main-content {
            padding-top: 70px;
        }

        /* =================== BUTTONS =================== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(108,99,255,0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108,99,255,0.5);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-light);
            border: 1px solid rgba(108,99,255,0.5);
        }

        .btn-outline:hover {
            background: rgba(108,99,255,0.1);
            border-color: var(--primary);
            color: white;
        }

        .btn-gold {
            background: linear-gradient(135deg, #ffd700 0%, #ff9900 100%);
            color: #1a1000;
            box-shadow: 0 4px 15px rgba(255,215,0,0.3);
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255,215,0,0.45);
        }

        .btn-success {
            background: var(--gradient-green);
            color: #0a2a1a;
            box-shadow: 0 4px 15px rgba(67,233,123,0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67,233,123,0.45);
        }

        .btn-lg { padding: 14px 32px; font-size: 1rem; }
        .btn-sm { padding: 8px 16px; font-size: 0.8rem; border-radius: 7px; }
        .btn-block { width: 100%; justify-content: center; }

        /* =================== CARDS =================== */
        .card {
            background: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            border-color: rgba(108,99,255,0.4);
            transform: translateY(-4px);
            box-shadow: var(--shadow-card);
        }

        /* =================== BADGES =================== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-primary { background: rgba(108,99,255,0.2); color: var(--primary-light); }
        .badge-success { background: rgba(67,233,123,0.15); color: var(--accent); }
        .badge-warning { background: rgba(255,215,0,0.15); color: var(--gold); }
        .badge-danger { background: rgba(255,101,132,0.15); color: var(--secondary); }
        .badge-info { background: rgba(56,249,215,0.15); color: var(--accent-blue); }
        .badge-secondary { background: rgba(255,255,255,0.1); color: var(--text-secondary); }
        .badge-hot { background: linear-gradient(135deg,#ff6584,#ffd700); color: white; }

        /* =================== SECTION =================== */
        .section {
            padding: 5rem 0;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(108,99,255,0.1);
            border: 1px solid rgba(108,99,255,0.3);
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary-light);
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }

        .section-title span {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* =================== FOOTER =================== */
        .footer {
            background: var(--dark-card);
            border-top: 1px solid var(--dark-border);
            padding: 4rem 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        .footer-brand .logo-text {
            font-size: 1.8rem;
            display: block;
            margin-bottom: 1rem;
        }

        .footer-desc {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .footer-socials {
            display: flex;
            gap: 10px;
        }

        .social-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: 1px solid var(--dark-border);
            background: var(--dark-card2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .social-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .footer-col-title {
            font-weight: 700;
            color: white;
            margin-bottom: 1.2rem;
            font-size: 0.95rem;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
        }

        .footer-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.88rem;
            transition: color 0.3s ease;
        }

        .footer-links a:hover { color: var(--primary-light); }

        .footer-bottom {
            border-top: 1px solid var(--dark-border);
            padding-top: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-copyright {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .footer-payment-icons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .payment-icon-badge {
            padding: 4px 10px;
            background: var(--dark-card2);
            border: 1px solid var(--dark-border);
            border-radius: 6px;
            font-size: 0.7rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* =================== TOAST =================== */
        #toast-container {
            position: fixed;
            top: 85px;
            right: 1.5rem;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 0.88rem;
            font-weight: 500;
            min-width: 260px;
            max-width: 380px;
            display: flex;
            align-items: center;
            gap: 10px;
            backdrop-filter: blur(10px);
            animation: slideIn 0.3s ease;
        }

        .toast-success {
            background: rgba(67,233,123,0.15);
            border: 1px solid rgba(67,233,123,0.4);
            color: var(--accent);
        }

        .toast-error {
            background: rgba(255,101,132,0.15);
            border: 1px solid rgba(255,101,132,0.4);
            color: var(--secondary);
        }

        .toast-info {
            background: rgba(108,99,255,0.15);
            border: 1px solid rgba(108,99,255,0.4);
            color: var(--primary-light);
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* =================== LOADING =================== */
        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* =================== RESPONSIVE =================== */
        @media (max-width: 1024px) {
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 2rem; }
        }

        @media (max-width: 768px) {
            .navbar-menu, .navbar-actions { display: none; }
            .hamburger { display: flex; }
            .section-title { font-size: 1.7rem; }
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar" id="mainNavbar">
        <a href="{{ route('home') }}" class="navbar-logo">
            <img src="{{ asset('images/logo.svg') }}" alt="PiannTopUp" style="height: 40px; width: auto;">
        </a>

        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('home') }}#games">Semua Game</a></li>
            <li><a href="{{ route('order.track') }}">Cek Pesanan</a></li>
            <li><a href="{{ route('home') }}#faq">FAQ</a></li>
        </ul>

        <div class="navbar-actions">
            <a href="{{ route('order.track') }}" class="btn-nav-cek">
                <i class="fas fa-search"></i> Cek Pesanan
            </a>
        </div>

        <div class="hamburger" id="hamburger" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <!-- MOBILE MENU -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Beranda</a>
        <a href="{{ route('home') }}#games"><i class="fas fa-gamepad"></i> Semua Game</a>
        <a href="{{ route('order.track') }}"><i class="fas fa-search"></i> Cek Pesanan</a>
        <a href="{{ route('home') }}#faq"><i class="fas fa-question-circle"></i> FAQ</a>
    </div>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <img src="{{ asset('images/logo.svg') }}" alt="PiannTopUp" style="height: 35px; width: auto; margin-bottom: 1rem;">
                    <p class="footer-desc">Platform top up game terpercaya dan tercepat di Indonesia. Nikmati kemudahan top up dengan harga terbaik dan proses otomatis 24/7.</p>
                    <div class="footer-socials">
                        <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-tiktok"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="footer-col-title">Layanan</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}#games">Top Up Game</a></li>
                        <li><a href="{{ route('order.track') }}">Cek Pesanan</a></li>
                        <li><a href="#">Promo & Diskon</a></li>
                        <li><a href="#">Review & Rating</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-col-title">Bantuan</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}#faq">FAQ</a></li>
                        <li><a href="#">Cara Pembayaran</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Live Chat</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-col-title">Perusahaan</h4>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Afiliasi</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-copyright">© {{ date('Y') }} PiannTopUp. All rights reserved. Made with ❤️</p>
                <div class="footer-payment-icons">
                    <span class="payment-icon-badge">BCA</span>
                    <span class="payment-icon-badge">BNI</span>
                    <span class="payment-icon-badge">Mandiri</span>
                    <span class="payment-icon-badge">GoPay</span>
                    <span class="payment-icon-badge">OVO</span>
                    <span class="payment-icon-badge">DANA</span>
                    <span class="payment-icon-badge">QRIS</span>
                    <span class="payment-icon-badge">Indomaret</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Container -->
    <div id="toast-container"></div>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('mainNavbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('open');
        }

        // Toast notification
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const icons = { success: 'fa-check-circle', error: 'fa-exclamation-circle', info: 'fa-info-circle' };
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.innerHTML = `<i class="fas ${icons[type]}"></i> ${message}`;
            container.appendChild(toast);
            setTimeout(() => { toast.style.opacity = '0'; toast.style.transform = 'translateX(100%)'; toast.style.transition = 'all 0.3s'; setTimeout(() => toast.remove(), 300); }, 3500);
        }

        // CSRF token for AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        // Number formatter
        function formatRupiah(number) {
            return 'Rp ' + parseInt(number).toLocaleString('id-ID');
        }
    </script>

    @stack('scripts')
</body>
</html>
