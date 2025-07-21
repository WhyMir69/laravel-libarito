@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Book</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('books.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Book Title</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">Author</label>
            <select name="author_id" class="form-select" required>
                <option value="">-- Choose Author --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Genres</label>
            @foreach($genres as $genre)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}"
                        {{ (is_array(old('genres')) && in_array($genre->id, old('genres'))) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $genre->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Book
        </button>
    </form>
</div>
@endsection
