@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    <form method="POST" action="{{ route('posts.update', $post['id']) }}">
        @csrf
        @method('PUT')

        <label>Title:</label><br>
        <input type="text" name="title" value="{{ old('title', $post['title']) }}"><br>
        @error('title') <span style="color:red">{{ $message }}</span><br> @enderror

        <label>Content:</label><br>
        <textarea name="content">{{ old('content', $post['content']) }}</textarea><br>
        @error('content') <span style="color:red">{{ $message }}</span><br> @enderror

        <button type="submit">Update</button>
    </form>
@endsection
