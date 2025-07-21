@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Author</h2>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Author Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Author</button>
        <a href="{{ route('library.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
