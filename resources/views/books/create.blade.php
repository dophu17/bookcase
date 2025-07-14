@extends('layouts.app')

@section('title', __('app.create_book'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> {{ __('app.create_book') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.book_name') }}</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.author') }}</label>
                            <input type="text" name="author_name" class="form-control @error('author_name') is-invalid @enderror" value="{{ old('author_name') }}">
                            @error('author_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.category') }}</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- {{ __('app.choose_category') }} --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.read_status') }}</label>
                            <select name="read_status" class="form-select @error('read_status') is-invalid @enderror">
                                <option value="not_read" {{ old('read_status') == 'not_read' ? 'selected' : '' }}>{{ __('app.not_read') }}</option>
                                <option value="reading" {{ old('read_status') == 'reading' ? 'selected' : '' }}>{{ __('app.reading') }}</option>
                                <option value="readed" {{ old('read_status') == 'readed' ? 'selected' : '' }}>{{ __('app.readed') }}</option>
                            </select>
                            @error('read_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.publisher') }}</label>
                            <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher') }}">
                            @error('publisher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.total_pages') }}</label>
                            <input type="number" name="total_pages" class="form-control @error('total_pages') is-invalid @enderror" value="{{ old('total_pages') }}">
                            @error('total_pages')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.cover_price') }}</label>
                            <input type="number" step="0.01" name="cover_price" class="form-control @error('cover_price') is-invalid @enderror" value="{{ old('cover_price') }}">
                            @error('cover_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.country') }}</label>
                            <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country') }}">
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">{{ __('app.back') }}</a>
                            <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> {{ __('app.create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 