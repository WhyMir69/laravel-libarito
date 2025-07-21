@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Review</h2>
    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <div class="mb-3">
            <label>Book</label>
            <select name="book_id" class="form-control">
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ ($bookId ?? '') == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control">{{ old('content') }}</textarea>
        </div>
        <div class="mb-3">
            <label>Rating</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ old('rating', 5) }}">
        </div>
        <button type="submit" class="btn btn-success">Add Review</button>
    </form>
</div>
@endsection
