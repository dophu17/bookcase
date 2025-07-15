@extends('layouts.app')

@section('title', __('app.settings'))

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-gear"></i> {{ __('app.settings') }}</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="daily_reminder_time" class="form-label">{{ __('app.daily_reminder_time') }}</label>
                            <input type="time" class="form-control" id="daily_reminder_time" name="daily_reminder_time" value="{{ old('daily_reminder_time', $setting?->daily_reminder_time ?? '12:00') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="spending_limit" class="form-label">{{ __('app.spending_limit') }}</label>
                            <input type="number" class="form-control" id="spending_limit" name="spending_limit" value="{{ old('spending_limit', $setting?->spending_limit ?? 5000000) }}" min="0" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> {{ __('app.save_changes') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 