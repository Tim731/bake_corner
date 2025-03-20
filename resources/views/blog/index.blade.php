@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="container mx-auto py-8 px-2">
        <a href="{{ route('blog.create') }}" class="btn btn-primary my-5">Create Blog</a>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($blogs as $blog)
                <div class="bg-base-100 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold mb-2">{{ $blog->title }}</h2>
                    <p class="text-info-content mb-2">
                        By <span class="font-bold">{{ $blog->author }}</span> -
                        {{ $blog->created_at->format('F j, Y') }}
                    </p>
                    <p class="text-info-content mb-4">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                    <div class="flex justify-between items-center">
                        <a href="{{ route('blog.show', $blog) }}" class="text-info hover:underline">Read More</a>
                        <div class="flex items-center">
                            <i data-lucide="message-square" class="w-4 h-4 mr-1 "></i>
                            <span class="text-sm">{{ $blog->comments_count }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
