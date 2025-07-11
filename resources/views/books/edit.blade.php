@extends('layouts.app')

@section('title', __('app.edit_book'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-pencil"></i> {{ __('app.edit_book') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.book_name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $book->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.author') }}</label>
                            <select name="author_id" class="form-select" required>
                                <option value="">-- {{ __('app.choose_author') }} --</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.category') }}</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- {{ __('app.choose_category') }} --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.read_status') }}</label>
                            <select name="read_status" class="form-select" required>
                                <option value="not_read" {{ old('read_status', $book->read_status) == 'not_read' ? 'selected' : '' }}>{{ __('app.not_read') }}</option>
                                <option value="reading" {{ old('read_status', $book->read_status) == 'reading' ? 'selected' : '' }}>{{ __('app.reading') }}</option>
                                <option value="readed" {{ old('read_status', $book->read_status) == 'readed' ? 'selected' : '' }}>{{ __('app.readed') }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.publisher') }}</label>
                            <input type="text" name="publisher" class="form-control" value="{{ old('publisher', $book->publisher) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.total_pages') }}</label>
                            <input type="number" name="total_pages" class="form-control" value="{{ old('total_pages', $book->total_pages) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.cover_price') }}</label>
                            <input type="number" step="0.01" name="cover_price" class="form-control" value="{{ old('cover_price', $book->cover_price) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('app.country') }}</label>
                            <input type="text" name="country" class="form-control" value="{{ old('country', $book->country) }}">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">{{ __('app.back') }}</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-pencil"></i> {{ __('app.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 