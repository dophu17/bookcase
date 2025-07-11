@extends('layouts.app')

@section('title', __('app.login'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h3 class="mb-0">
                        <i class="bi bi-box-arrow-in-right"></i> {{ __('app.login') }}
                    </h3>
                    <p class="mb-0 mt-2">{{ __('app.welcome_back') }}</p>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope"></i> {{ __('app.email_address') }}
                            </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock"></i> {{ __('app.password') }}
                            </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('app.remember_me') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> {{ __('app.login') }}
                            </button>
                        </div>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                                                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                <i class="bi bi-question-circle"></i> {{ __('app.forgot_password') }}
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3 bg-light">
                    <p class="mb-0">
                        {{ __('app.dont_have_account') }} 
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                <i class="bi bi-person-plus"></i> {{ __('app.register_now') }}
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 