@extends('layouts.app')

@section('title', __('app.collections'))

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="bi bi-speedometer2"></i> {{ __('app.collections') }}
                </h1>
                <div class="text-muted">
                    @if(Auth::check())
                    {{ __('app.welcome') }}, {{ Auth::user()->name }}!
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">{{ __('app.total_books') }}</h4>
                            <h2 class="mb-0">{{ $totalBooks }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-book" style="font-size: 2.5rem; opacity: 0.7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">{{ __('app.read_books') }}</h4>
                            <h2 class="mb-0">{{ $readBooks }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-check-circle" style="font-size: 2.5rem; opacity: 0.7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">{{ __('app.reading_books') }}</h4>
                            <h2 class="mb-0">{{ $readingBooks }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-bookmark" style="font-size: 2.5rem; opacity: 0.7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">{{ __('app.not_read') }}</h4>
                            <h2 class="mb-0">{{ $notReadBooks }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-collection" style="font-size: 2.5rem; opacity: 0.7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- statistical -->
    <div class="row mb-4">
        <div class="col-md-2 col-6 mb-2">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="fw-bold">{{ __('app.total_book_cost') }}</div>
                    <div>{{ number_format($totalCost, 0, ',', '.') }} đ</div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="fw-bold">{{ __('app.total_authors') }}</div>
                    <div>{{ $totalAuthors }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="fw-bold">{{ __('app.total_categories') }}</div>
                    <div>{{ $totalCategories }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="fw-bold">{{ __('app.total_countries') }}</div>
                    <div>{{ $totalCountries }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="fw-bold">{{ __('app.most_category') }}</div>
                    <div>{{ $mostCategoryName ?? '-' }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6 mb-2">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="fw-bold">{{ __('app.most_country') }}</div>
                    <div>{{ $mostCountryName ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- manager books -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-book"></i> {{ __('app.manager_books') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="{{ route('analyze-book-image') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="book_image" class="form-control" accept="image/*">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="bi bi-upload"></i> {{ __('app.upload_image') }}
                                    </button>
                                </form>
                                <form action="" method="GET" class="d-flex" style="max-width: 400px;">
                                    <input type="text" name="search" class="form-control me-2" placeholder="{{ __('app.search_books') }}" value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </form>
                                <a href="{{ route('books.create') }}" class="btn btn-success ms-2">
                                    <i class="bi bi-plus-circle"></i> {{ __('app.create_book') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>    
                                    <th>{{ __('app.book_name') }}</th>
                                    <th>{{ __('app.author') }}</th>
                                    <th>{{ __('app.category') }}</th>
                                    <th>{{ __('app.read_status') }}</th>
                                    <th>{{ __('app.publisher') }}</th>
                                    <th>{{ __('app.total_pages') }}</th>    
                                    <th>{{ __('app.cover_price') }}</th>
                                    <th>{{ __('app.country') }}</th>
                                    <th>{{ __('app.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->author_name }}</td>
                                        <td>{{ optional($book->category)->name }}</td>
                                        <td>
                                            @if($book->read_status === 'readed')
                                                <span class="badge bg-success">{{ __('app.readed') }}</span>
                                            @elseif($book->read_status === 'reading')
                                                <span class="badge bg-warning text-dark">{{ __('app.reading') }}</span>
                                            @elseif($book->read_status === 'not_read')
                                                <span class="badge bg-info text-dark">{{ __('app.not_read') }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $book->read_status }}</span>
                                            @endif
                                        </td>   
                                        <td>{{ $book->publisher }}</td>
                                        <td>{{ $book->total_pages }}</td>
                                        <td>{{ number_format($book->cover_price, 0, ',', '.') }} đ</td>
                                        <td>{{ $book->country }}</td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-primary"> 
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>   
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $books->links('pagination::bootstrap-5') }}
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history"></i> {{ __('app.recent_activity') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                        <p class="mt-3">{{ __('app.no_activity') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 