@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
    {{-- pagina grande --}}
    <div class="hidden xl:inline">
        <div class="container mx-auto px-64 pt-8">
            <!-- Title -->
                    <h1 class="text-4xl font-bold mb-3">{{ $post->title }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Poster Image -->
                <div class="flex justify-between h-max">
                    <img src="/assets/img/comicCovers/{{ $post->coverImg }}" alt="{{ $post->title }}"
                        class="rounded-lg shadow-lg">
                </div>
                <div class="flex justify-between h-max">
                    <img src="/assets/img/moviePoster/{{ $post->moviePoster }}" alt="{{ $post->title }}"
                        class="rounded-lg shadow-lg">
                </div>
                <!-- Content Section -->
                <div class="flex flex-col">
                    <!-- Release Date and Duration -->
                    <div class="flex space-x-4 text-gray-600 mb-3">
                        <span class="flex items-between">
                            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6 2a1 1 0 000 2h1v1a1 1 0 102 0V4h2v1a1 1 0 102 0V4h1a1 1 0 100-2H6zM3 8a1 1 0 011-1h12a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm2 1v8h10V9H5z">
                                </path>
                            </svg>
                            {{ \Carbon\Carbon::parse($post->releaseDate)->format('Y') }}
                        </span>

                    </div>

                    <!-- Content -->
                    <div class="prose max-w-none mb-4">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- pagina celular --}}
    <div class="xl:hidden">
        <div class="container px-5 pt-8">
            <div class="flex-column">
                <!-- Poster Image -->
                <div class="flex justify-between h-max">
                    <img src="/assets/img/comicCovers/{{ $post->coverImg }}" alt="{{ $post->title }}"
                        class="rounded-lg shadow-lg mb-10">
                </div>
                <!-- Content Section -->
                <div class="flex flex-col justify-between">
                    <!-- Title -->
                    <h1 class="text-5xl font-bold text-center">{{ $post->title }}</h1>
                    <!-- Release Date and Duration -->
                    <div class="flex space-x-4 text-gray-600 mb-4 justify-center">
                        <span class="flex items-between">
                            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6 2a1 1 0 000 2h1v1a1 1 0 102 0V4h2v1a1 1 0 102 0V4h1a1 1 0 100-2H6zM3 8a1 1 0 011-1h12a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm2 1v8h10V9H5z">
                                </path>
                            </svg>
                            {{ \Carbon\Carbon::parse($post->releaseDate)->format('d M Y') }}
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="prose max-w-none mb-4">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-5 xl:px-64 py-8">
        <!-- Pages -->
        @if ($post->pages->isNotEmpty())
            <div class="flex flex-wrap space-x-4 mb-4">
                @foreach ($post->pages as $page)
                    <img src="{{ asset('assets/img/comicPages/' . $page->image) }}" alt="{{ $page->name }}"
                        class="w-32 h-28 object-cover rounded-lg">
                @endforeach
            </div>
        @endif

            <a href="{{ $post->link }}">Leitura Online</a>
    </div>


@endsection

@section('footer')
    <x-footer />
@endsection
