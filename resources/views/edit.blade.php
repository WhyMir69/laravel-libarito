@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Review</h2>

    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="rating">Rating (1–5):</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ old('rating', $review->rating) }}" required>
        </div>

        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea name="comment" class="form-control">{{ old('comment', $review->comment) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Review</button>
    </form>
</div>
@endsection
