@extends('layouts.app')

@section('content')
    <h1>All Posts</h1>

    @if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif
    @if(session('error')) <p style="color:red">{{ session('error') }}</p> @endif

    <a href="{{ route('posts.create') }}">Create New Post</a>
    <ul>
        @forelse ($posts as $post)
            <li>
                <strong>{{ $post['title'] }}</strong><br>
                {{ $post['content'] }}<br>
                <a href="{{ route('posts.edit', $post['id']) }}">Edit</a> |

                <form method="POST" action="{{ route('posts.destroy', $post['id']) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @empty
            <li>No posts found.</li>
        @endforelse
    </ul>
@endsection
