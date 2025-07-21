@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Genre</h2>

    <form action="{{ route('genres.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Genre Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Genre</button>
        <a href="{{ route('library.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
