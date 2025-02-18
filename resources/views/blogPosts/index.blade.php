@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
    <div class="container mx-auto px-4 pt-16 pb-32">


        {{-- title  --}}
        <h2 class="text-4xl font-black mb-8">PUBLICAÇÕES</h2>

        @foreach ($blogPosts as $post)
        <a href="{{ route('blog.show', $post->id)}}">
            <div class="bg-transparent overflow-hidden mb-8 p-6">

                     {{-- horizontal line --}}
         <div>
            <hr class="border-gray-300 my-4">
        </hr>
        </div>
                <!-- Title and Date -->
                <h3 class="text-2xl font-semibold text-gray-800">{{ $post->title }}</h3>
                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</p>

                <!-- Video (if available) -->
                @if($post->video)
                    <div class="mt-4">
                        <iframe src="{{ $post->video }}" class="w-full h-64 rounded-lg" frameborder="0"></iframe>
                    </div>
                @endif

                <!-- Description -->
                <p class="text-gray-700 mt-4 line-clamp-3">
                    {!! Str::limit(strip_tags($post->content), 500, '...') !!}
                </p>

                <!-- Image Preview -->
                @if($post->image)
                    <div class="mt-4 flex justify-start">
                        <img src="{{ asset('assets/img/blogImages/' . $post->image) }}" alt="Post Image"
                            class="max-w-32 rounded-lg">
                    </div>
                @endif
                {{-- horizontal line --}}
                <div>
                    <hr class="border-gray-300 my-4">
                </hr>
                </div>
            </div>
        </a>
        @endforeach

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $blogPosts->links() }}
        </div>
    </div>
@endsection


@section('footer')
    <x-footer />
@endsection
