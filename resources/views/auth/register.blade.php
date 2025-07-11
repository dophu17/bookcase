@extends('layouts.app')

@section('title', __('app.register'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center py-4">
                    <h3 class="mb-0">
                        <i class="bi bi-person-plus"></i> {{ __('app.register') }}
                    </h3>
                    <p class="mb-0 mt-2">{{ __('app.welcome_back') }}</p>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label">
                                <i class="bi bi-person"></i> {{ __('app.full_name') }}
                            </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope"></i> {{ __('app.email_address') }}
                            </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
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
                                   name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">
                                <i class="bi bi-lock-fill"></i> {{ __('app.confirm_password') }}
                            </label>
                            <input id="password-confirm" type="password" class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    {{ __('app.agree_terms') }} <a href="#" class="text-decoration-none">{{ __('app.terms_of_service') }}</a> và 
                                    <a href="#" class="text-decoration-none">{{ __('app.privacy_policy') }}</a>
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-person-plus"></i> {{ __('app.register') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3 bg-light">
                    <p class="mb-0">
                        {{ __('app.already_have_account') }} 
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <i class="bi bi-box-arrow-in-right"></i> {{ __('app.login_here') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 