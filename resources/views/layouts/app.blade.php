<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bookcase') }} - @yield('title', __('app.home'))</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #2c3e50 !important;
        }
        .navbar-nav .nav-link {
            color: #34495e !important;
            font-weight: 500;
        }
        .navbar-nav .nav-link:hover {
            color: #3498db !important;
        }
        .btn-login {
            background-color: #3498db;
            border-color: #3498db;
            color: white;
        }
        .btn-login:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            color: white;
        }
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
        }
        .feature-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0 20px;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-book"></i> Bookcase
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="bi bi-house"></i> {{ __('app.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-collection"></i> {{ __('app.books') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-person"></i> {{ __('app.authors') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-info-circle"></i> {{ __('app.about') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-envelope"></i> {{ __('app.contact') }}
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <!-- Language Switcher -->
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-globe"></i> {{ config('app.available_locales')[app()->getLocale()] ?? 'Language' }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach(config('app.available_locales') as $locale => $name)
                                <li>
                                    <a class="dropdown-item {{ app()->getLocale() === $locale ? 'active' : '' }}" 
                                       href="{{ route('language.switch', $locale) }}">
                                        {{ $name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    
                    @guest
                        <li class="nav-item">
                            <a class="nav-link btn btn-login" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> {{ __('app.login') }}
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item ms-2">
                                <a class="nav-link btn btn-outline-primary" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus"></i> {{ __('app.register') }}
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('books.index') }}"><i class="bi bi-speedometer2"></i> {{ __('app.collections') }}</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> {{ __('app.profile') }}</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> {{ __('app.settings') }}</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('app.logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="bi bi-book"></i> Bookcase</h5>
                    <p>{{ __('app.bookcase_description') }}</p>
                </div>
                <div class="col-md-4">
                    <h5>{{ __('app.quick_links') }}</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">{{ __('app.home') }}</a></li>
                        <li><a href="#" class="text-light">{{ __('app.books') }}</a></li>
                        <li><a href="#" class="text-light">{{ __('app.authors') }}</a></li>
                        <li><a href="#" class="text-light">{{ __('app.contact') }}</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>{{ __('app.contact_info') }}</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-envelope"></i> info@bookcase.com</li>
                        <li><i class="bi bi-telephone"></i> +84 123 456 789</li>
                        <li><i class="bi bi-geo-alt"></i> Hà Nội, Việt Nam</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Bookcase. {{ __('app.all_rights_reserved') }}</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html> 