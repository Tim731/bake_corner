@extends('layouts.app')

@section('content')
    <div class="w-full bg-base-200">
        <div class="w-full max-w-200 mx-auto py-8 px-5 md:p-12 bg-base-100">
            <h1 class="text-3xl font-bold mb-6">{{ $blog->title }}</h1>
            <p class="text-secondary font-bold text-sm mb-4">By {{ $blog->author }} -
                {{ $blog->created_at->format('F j, Y') }}</p>
            <div class="mb-6">
                {!! $blog->content !!}
            </div>


        </div>
        <div class="w-full max-w-200 mx-auto py-8 px-5 mt-5 md:p-12 bg-base-100">
            <h2 class="text-2xl font-bold mb-4">Comments</h2>
            @if (session('success'))
                <div class="bg-base-100 border border-success text-success px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @foreach ($comments as $comment)
                <div class="bg-gray-100 p-4 rounded-lg mb-4">
                    <p class="font-bold">{{ $comment->name }}</p>
                    <p class="text-primary">{{ $comment->comment }}</p>
                    <p class="text-gray-500 text-sm">
                        {{ $comment->created_at->diffForHumans() }}
                    </p>
                </div>
            @endforeach

            <h3 class="text-xl font-bold mb-4">Add a Comment</h3>
            <form action="{{ route('blog.comment.store', $blog) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-primary font-bold mb-2">Name</label>
                    <input type="text" name="name" id="name"
                        class="input input-primary w-full"
                        required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-primary font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email"
                        class="input input-primary w-full"
                        required>
                </div>
                <div class="mb-4">
                    <label for="comment" class="block text-primary font-bold mb-2">Comment</label>
                    <textarea name="comment" id="comment" rows="4"
                        class="textarea textarea-primary w-full"
                        required></textarea>
                </div>
                <button type="submit"
                    class="btn btn-primary">Submit
                    Comment</button>
            </form>
        </div>
    </div>
@endsection
