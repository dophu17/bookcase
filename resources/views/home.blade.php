@extends('layouts.app')

@section('title', __('app.home'))

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">{{ __('app.welcome_to_bookcase') }}</h1>
                <p class="lead mb-4">{{ __('app.home_subtitle') }}</p>
                <div class="d-flex gap-3">
                    @if(Auth::check())
                        <a href="{{ route('books.create') }}" class="btn btn-light btn-lg">
                            <i class="bi bi-plus"></i> {{ __('app.add_new_book') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> {{ __('app.login_now') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-person-plus"></i> {{ __('app.register_free') }}
                            </a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="bi bi-book" style="font-size: 15rem; opacity: 0.3;"></i>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3">{{ __('app.features') }}</h2>
                <p class="lead text-muted">{{ __('app.features_subtitle') }}</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-search text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title">{{ __('app.smart_search') }}</h5>
                        <p class="card-text">{{ __('app.smart_search_desc') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-collection text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title">{{ __('app.collection_management') }}</h5>
                        <p class="card-text">{{ __('app.collection_management_desc') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card feature-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <i class="bi bi-share text-info" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title">{{ __('app.easy_sharing') }}</h5>
                        <p class="card-text">{{ __('app.easy_sharing_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <i class="bi bi-book text-primary" style="font-size: 2.5rem;"></i>
                    <h3 class="fw-bold mt-3">10,000+</h3>
                    <p class="text-muted">{{ __('app.books_in_library') }}</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <i class="bi bi-person text-success" style="font-size: 2.5rem;"></i>
                    <h3 class="fw-bold mt-3">5,000+</h3>
                    <p class="text-muted">{{ __('app.authors_count') }}</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <i class="bi bi-people text-info" style="font-size: 2.5rem;"></i>
                    <h3 class="fw-bold mt-3">2,000+</h3>
                    <p class="text-muted">{{ __('app.users_count') }}</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4">
                    <i class="bi bi-collection text-warning" style="font-size: 2.5rem;"></i>
                    <h3 class="fw-bold mt-3">500+</h3>
                    <p class="text-muted">{{ __('app.collections_count') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <h2 class="display-6 fw-bold mb-4">{{ __('app.start_journey') }}</h2>
                <p class="lead mb-4">{{ __('app.start_journey_desc') }}</p>
                <div class="justify-content-center">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-plus-circle text-primary" style="font-size: 3rem;"></i>
                                    <h5 class="card-title mt-3">{{ __('app.add_new_book') }}</h5>
                                    <p class="card-text">{{ __('app.add_book_desc') }}</p>
                                    <a href="{{ route('books.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus"></i> {{ __('app.add_new_book') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-search text-success" style="font-size: 3rem;"></i>
                                    <h5 class="card-title mt-3">{{ __('app.search_books') }}</h5>
                                    <p class="card-text">{{ __('app.search_books_desc') }}</p>
                                    <a href="{{ route('books.index') }}" class="btn btn-success">
                                        <i class="bi bi-search"></i> {{ __('app.search_books') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-collection text-info" style="font-size: 3rem;"></i>
                                    <h5 class="card-title mt-3">{{ __('app.manage_collections') }}</h5>
                                    <p class="card-text">{{ __('app.manage_collections_desc') }}</p>
                                    <a href="{{ route('books.index') }}" class="btn btn-info">
                                        <i class="bi bi-collection"></i> {{ __('app.manage_collections') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 