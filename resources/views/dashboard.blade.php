@extends('layouts.app')

@section('title', __('app.dashboard'))

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="bi bi-speedometer2"></i> {{ __('app.dashboard') }}
                </h1>
                <div class="text-muted">
                    {{ __('app.welcome') }}, {{ Auth::user()->name }}!
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
                            <h2 class="mb-0">0</h2>
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
                            <h2 class="mb-0">0</h2>
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
                            <h2 class="mb-0">0</h2>
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
                            <h4 class="card-title">{{ __('app.collections') }}</h4>
                            <h2 class="mb-0">0</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="bi bi-collection" style="font-size: 2.5rem; opacity: 0.7;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-5">
        <div class="col-12">
            <h4 class="mb-3">
                <i class="bi bi-lightning"></i> {{ __('app.quick_actions') }}
            </h4>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-plus-circle text-primary" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">{{ __('app.add_new_book') }}</h5>
                    <p class="card-text">{{ __('app.add_book_desc') }}</p>
                    <a href="#" class="btn btn-primary">
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
                    <a href="#" class="btn btn-success">
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
                    <a href="#" class="btn btn-info">
                        <i class="bi bi-collection"></i> {{ __('app.manage_collections') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- manager books -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('books.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> {{ __('app.create_book') }}
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-book"></i> {{ __('app.manager_books') }}
                    </h5>
                </div>
                <div class="card-body">
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
                                        <td>{{ optional($book->author)->name }}</td>
                                        <td>{{ optional($book->category)->name }}</td>
                                        <td>{{ $book->read_status }}</td>   
                                        <td>{{ $book->publisher }}</td>
                                        <td>{{ $book->total_pages }}</td>
                                        <td>{{ $book->cover_price }}</td>
                                        <td>{{ $book->country }}</td>
                                        <td>
                                            <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-primary"> 
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline-block" onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>   
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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