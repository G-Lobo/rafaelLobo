@extends('layouts.rafaelLobo')

@section('content')


    <style>
        .prose * {
            color: white !important
        }
    </style>
    <div class="relative min-h-screen text-white">
        <x-background-image :overlay="true" />

        <!-- Header -->

        <header class="pb-20">
            <x-headerWhite />
        </header>

        <div class="container mx-auto px-4 md:px-8 lg:px-8 py-8 relative z-10">
            <h1 class="text-4xl font-bold mb-3">{{ $post->title }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex justify-between h-max">
                    <img src="/assets/img/comicCovers/{{ $post->coverImg }}" alt="{{ $post->title }}"
                        class="rounded-lg shadow-lg">
                </div>
                <div class="flex justify-between h-max">
                    <img src="/assets/img/moviePoster/{{ $post->moviePoster }}" alt="{{ $post->title }}"
                        class="rounded-lg shadow-lg">
                </div>
            </div>
            <div class="flex flex-col">
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

                <div class="prose max-w-none mb-4">
                    {!! $post->content !!}
                </div>
            </div>

            <div class="container mx-auto px-5 xl:px-64">
                <div class="text-center font-bold text-xl mb-4">
                    <a href="{{ $post->link }}">Leitura Online</a>
                </div>
                @if ($post->pages->isNotEmpty())
                    <div class="flex-col  my-4">
                        @foreach ($post->pages as $page)
                            <img src="{{ asset('assets/img/comicPages/' . $page->image) }}" alt="{{ $page->name }}"
                                class=" h-full object-cover rounded-lg mb-5">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection
