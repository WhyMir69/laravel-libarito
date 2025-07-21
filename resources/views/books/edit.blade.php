@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Book</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}">
        </div>

        <div class="mb-3">
            <label>Author</label>
            <select name="author_id" class="form-select">
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Genres</label>
            @foreach($genres as $genre)
                <div class="form-check">
                    <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                        class="form-check-input"
                        {{ $book->genres->contains($genre->id) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $genre->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
