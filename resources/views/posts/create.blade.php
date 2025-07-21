@extends('layouts.app')

@section('content')
    <h1>Create New Post</h1>

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <label>Title:</label><br>
        <input type="text" name="title" value="{{ old('title') }}"><br>
        @error('title') <span style="color:red">{{ $message }}</span><br> @enderror

        <label>Content:</label><br>
        <textarea name="content">{{ old('content') }}</textarea><br>
        @error('content') <span style="color:red">{{ $message }}</span><br> @enderror

        <button type="submit">Submit</button>
    </form>
@endsection
