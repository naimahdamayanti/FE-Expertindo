@php
$user = session('user');

$menus = [];

// Cek apakah user tidak null dan punya role
if ($user && $user->role === 'admin') {
    $menus = [
        (object)[ 'title' => 'Home', 'path' => 'dashboard', 'icon' => 'lni lni-home' ],
        (object)[ 'title' => 'Jadwal', 'path' => 'jadwal', 'icon' => 'lni lni-calendar' ],
        (object)[ 'title' => 'Artikel', 'path' => 'artikel', 'icon' => 'lni lni-write' ],
        (object)[ 'title' => 'Kontak', 'path' => 'kontak', 'icon' => 'lni lni-phone' ],
    ];
} elseif ($user && $user->role === 'user') {
    $menus = [
        (object)[ 'title' => 'Home', 'path' => 'dashboard', 'icon' => 'lni lni-home' ],
        (object)[ 'title' => 'Jadwal', 'path' => 'jadwal', 'icon' => 'lni lni-calendar' ],
        (object)[ 'title' => 'Artikel', 'path' => 'artikel', 'icon' => 'lni lni-write' ],
        (object)[ 'title' => 'Kontak', 'path' => 'kontak', 'icon' => 'lni lni-phone' ],
    ];
}
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('template/assets/img/logo/logo-expertindo.png') }}">
    <title>Expertindo Training | @yield('title')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap-5.0.0-beta2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/LineIcons.2.0.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @stack('styles')
    
    <style>
        .navbar {
            background: linear-gradient(135deg, #ff0000ff 0%, #ff0000ff 100%);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .user-panel-navbar {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            backdrop-filter: blur(10px);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
            color: black;
        }
        
        .user-info .user-email {
            font-size: 14px;
            font-weight: 600;
            margin: 0;
        }
        
        .user-info .user-role {
            font-size: 11px;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .status-indicator {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .logout-button {
            background: linear-gradient(135deg, #f5365c, #f56036);
            border: none;
            color: black;
            padding: 8px 20px;
            font-weight: 600;
            border-radius: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(245, 54, 92, 0.3);
            font-size: 14px;
        }
        
        .logout-button:hover {
            background: linear-gradient(135deg, #f56036, #f5365c);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(245, 54, 92, 0.4);
        }
        
        .logout-button i {
            transition: transform 0.3s ease;
        }
        
        .logout-button:hover i {
            transform: rotate(-15deg);
        }
        
        /* Mobile adjustments */
        @media (max-width: 991px) {
            .user-panel-navbar {
                margin-top: 10px;
                width: 100%;
                justify-content: center;
            }
            
            .navbar-nav {
                margin-top: 15px;
            }
            
            .logout-button {
                width: 100%;
                justify-content: center;
                margin-top: 10px;
            }
        }
        
        .navbar-nav .nav-link {
            color: rgba(0, 0, 0, 1) !important;
            font-weight: 500;
            padding: 8px 15px !important;
            transition: all 0.3s ease;
            border-radius: 8px;
        }
        
        .navbar-nav .nav-link:hover {
            background: rgba(241, 236, 236, 1);
            color: black !important;
        }
        
        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: black !important;
        }

        /* Footer */
        body {
            margin: 0;
            padding: 0;
        }

        html, body {
            width: 100%;
            overflow-x: hidden;
            background: #000;
        }

        .footer {
            background: #000 !important;
            color: #fff;
            padding: 60px 0 20px;
            margin-top: 80px;
            width: 100vw !important;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }
                
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
                }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #333;
            color: #666;
            font-size: 14px;
            max-width: 1200px; 
            margin: 0 auto;
        }
        
        .footer-logo {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .logo-img {
            width: 180px;
            height: auto;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            background: #333;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: #e53935;
            transform: translateY(-3px);
        }
        
        .footer-column h3 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #fff;
        }
        
        .footer-column ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-column ul li {
            margin-bottom: 12px;
        }
        
        .footer-column ul li a {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        
        .footer-column ul li a:hover {
            color: #e53935;
        }
        
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #aaa;
            font-size: 14px;
        }
        
        .contact-item i {
            color: #e53935;
            margin-top: 3px;
        }
        
        .contact-item a {
            color: #aaa;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .contact-item a:hover {
            color: #e53935;
        }
        
        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .newsletter-form input {
            padding: 12px 15px;
            border: 1px solid #333;
            border-radius: 5px;
            background: #1a1a1a;
            color: #fff;
            font-size: 14px;
        }
        
        .newsletter-form input:focus {
            outline: none;
            border-color: #e53935;
        }
        
        .newsletter-form textarea {
            padding: 12px 15px;
            border: 1px solid #333;
            border-radius: 5px;
            background: #1a1a1a;
            color: #fff;
            font-size: 14px;
            resize: vertical;
            min-height: 100px;
        }
        
        .newsletter-form textarea:focus {
            outline: none;
            border-color: #e53935;
        }
        
        .newsletter-form button {
            padding: 12px 30px;
            background: #e53935;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .newsletter-form button:hover {
            background: #d32f2f;
            transform: translateY(-2px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #333;
            color: #666;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="navbar-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-dark">
                            <!-- Logo -->
                            <a class="navbar-brand" href="{{ url('dashboard') }}">
                                <img src="{{ asset('template/assets/img/logo/logo-expertindo.png') }}" 
                                     alt="logo" 
                                     style="height: 50px;" />
                            </a>
                            
                            <!-- Toggler Button -->
                            <button class="navbar-toggler" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#navbarContent" 
                                    aria-controls="navbarContent" 
                                    aria-expanded="false" 
                                    aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            
                            <!-- Navbar Content -->
                            <div class="collapse navbar-collapse" id="navbarContent">
                                <!-- Menu Navigation -->
                                @if ($user)
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    @foreach($menus as $menu)
                                    <li class="nav-item">
                                        <a href="{{ url($menu->path) }}"
                                           class="nav-link {{ request()->is($menu->path) ? 'active' : '' }}">
                                            <i class="{{ $menu->icon }}"></i>
                                            {{ $menu->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                
                                <!-- User Panel & Logout -->
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <!-- User Info -->
                                    <div class="user-panel-navbar">
                                        <div class="user-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="user-info">
                                            <p class="user-email mb-0">{{ session('nama', $user->nama ?? $user->email) }}</p>
                                            <span class="user-role">
                                                <span class="status-indicator"></span>
                                                {{ $user->role === 'admin' ? 'Administrator' : 'Pengguna' }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Logout Button -->
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="logout-button">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Log Out</span>
                                        </button>
                                    </form>
                                </div>
                                @else
                                <div class="text-center text-white p-3">
                                    <p class="mb-0">Silakan login untuk melanjutkan</p>
                                </div>
                                @endif
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container-fluid py-4 mt-2">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-success">@yield('judul')</h6>
                    </div>
                    <div class="card-body">
                        @yield('isi')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Logo & Social -->
            <div class="footer-logo">
                <img src="{{ asset('template/assets/img/logo/logo-expertindo.png') }}" alt="Expertindo Logo" class="logo-img">
                <div class="social-links">
                    <a href="#" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="Email"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            
            <!-- Menu -->
            <div class="footer-column">
                <h3>Menu</h3>
                <ul>
                    <li><a href="{{ url('dashboard') }}">Home</a></li>
                    <li><a href="{{ url('jadwal') }}">Layanan Kami</a></li>
                    <li><a href="{{ url('artikel') }}">Artikel</a></li>
                </ul>
            </div>
            
            <!-- Kontak Kami -->
            <div class="footer-column">
                <h3>Kontak Kami</h3>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jl. Keturan Lor 10, Sleman, Yogyakarta</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <a href="tel:+6281323096206">(+62) 81323096206 (Nisa)</a>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:marketing@indo-training.com">marketing@indo-training.com</a>
                    </div>
                </div>
            </div>
            
            <!-- Kirim Pesan -->
            <div class="footer-column">
                <h3>Kirim Pesan</h3>
                <form class="newsletter-form">
                    <input type="text" placeholder="Nama Lengkap" required>
                    <input type="email" placeholder="Email" required>
                    <textarea placeholder="Pesan Anda" required></textarea>
                    <button type="submit">KIRIM</button>
                </form>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>© 2011-2025 PT. Expertindo Training</p>
        </div>
    </div>
</footer>

    <!-- Core JS Files -->
    <script src="{{ asset('template/assets/js/bootstrap-5.0.0-beta2.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/polyfill.js') }}"></script>
    <script src="{{ asset('template/assets/js/count-up.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('template/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/main.js') }}"></script>

    <script>
        // Highlight active menu
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                const linkPath = new URL(link.href).pathname;
                if (linkPath === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>

    <!-- TAMBAHAN INI PENTING! -->
    @yield('scripts')
    @stack('scripts')
    
</body>

</html>