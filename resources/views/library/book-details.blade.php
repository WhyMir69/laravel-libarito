@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $book->title }}</h2>
    <p><strong>Author:</strong> {{ $book->author->name }}</p>

    <p><strong>Genres:</strong>
        @foreach ($book->genres as $genre)
            {{ $genre->name }}@if (!$loop->last), @endif
        @endforeach
    </p>

    <!-- Edit/Delete Book Button -->
    <div class="mb-4">
        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil-square"></i> Edit Book
        </a>

        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this book?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i> Delete Book
            </button>
        </form>
    </div>

    <hr>

    <h4>Reviews:</h4>
    @forelse ($book->reviews as $review)
        <div class="mb-3">
            <strong>Rating:</strong> {{ $review->rating }}<br>
            {{ $review->content }}
        </div>
    @empty
        <p>No reviews yet.</p>
    @endforelse

    <hr>

    <h4>Add a new review</h4>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <div class="mb-3">
            <label for="rating" class="form-label">Rating:</label>
            <select name="rating" class="form-select" required>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Review:</label>
            <textarea name="content" rows="3" class="form-control" required>{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>
@endsection
