@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-book"></i> Libretto Library System</h2>
            <a href="{{ route('library.test') }}" class="btn btn-info" target="_blank">
                <i class="bi bi-gear"></i> Test Relationships
            </a>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{ $stats['total_books'] }}</h4>
                                <p class="mb-0">Total Books</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-book-fill fs-2"></i>
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
                                <h4>{{ $stats['total_authors'] }}</h4>
                                <p class="mb-0">Authors</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-person-fill fs-2"></i>
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
                                <h4>{{ $stats['total_genres'] }}</h4>
                                <p class="mb-0">Genres</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-tags-fill fs-2"></i>
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
                                <h4>{{ $stats['total_reviews'] }}</h4>
                                <p class="mb-0">Reviews</p>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-star-fill fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Books Section -->
        <div class="row">
            <div class="col-md-8">
                <h3>Books</h3>
                <div class="row">
                    @foreach($books as $book)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <p class="card-text">
                                        <strong>Author:</strong> 
                                        <a href="{{ route('library.author', $book->author->id) }}" class="text-decoration-none">
                                            {{ $book->author->name }}
                                        </a>
                                    </p>
                                    <p class="card-text">
                                        <strong>Genres:</strong>
                                        @foreach($book->genres as $genre)
                                            <a href="{{ route('library.genre', $genre->id) }}" class="badge bg-secondary text-decoration-none me-1">
                                                {{ $genre->name }}
                                            </a>
                                        @endforeach
                                    </p>
                                    <p class="card-text">
                                        <strong>Rating:</strong>
                                        @if($book->reviews->count() > 0)
                                            {{ number_format($book->reviews->avg('rating'), 1) }}/5 
                                            <small class="text-muted">({{ $book->reviews->count() }} reviews)</small>
                                        @else
                                            <small class="text-muted">No reviews yet</small>
                                        @endif
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('library.book', $book->id) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Authors & Genres Sidebar -->
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <h4>Authors</h4>
                        <div class="list-group">
                            @foreach($authors as $author)
                                <a href="{{ route('library.author', $author->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $author->name }}
                                    <span class="badge bg-primary rounded-pill">{{ $author->books_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <h4>Genres</h4>
                        <div class="list-group">
                            @foreach($genres as $genre)
                                <a href="{{ route('library.genre', $genre->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $genre->name }}
                                    <span class="badge bg-secondary rounded-pill">{{ $genre->books_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
