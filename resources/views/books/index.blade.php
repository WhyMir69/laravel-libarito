@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Books</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($books->isEmpty())
        <p>No books found.</p>
    @else
        <div class="list-group">
            @foreach($books as $book)
                <div class="list-group-item">
                    <h5>{{ $book->title }}</h5>
                    <p><strong>Author:</strong> {{ $book->author->name }}</p>
                    <p><strong>Genres:</strong>
                        @foreach($book->genres as $genre)
                            <span class="badge bg-secondary">{{ $genre->name }}</span>
                        @endforeach
                    </p>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
