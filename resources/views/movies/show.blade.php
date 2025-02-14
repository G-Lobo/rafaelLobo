@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')
    <div class="container mx-auto px-64 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Poster Image -->
            <div class="flex justify-between h-max">
                <img src="/assets/img/coverArts/{{ $post->coverArt }}" alt="{{ $post->title }}" class="rounded-lg shadow-lg">
            </div>
            <!-- Content Section -->
            <div class="flex flex-col justify-between">
                <!-- Title -->
                <h1 class="text-5xl font-bold mb-4">{{ $post->title }}</h1>
                <!-- Release Date and Duration -->
                <div class="flex space-x-4 text-gray-600 mb-4">
                    <span class="flex items-between">
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 2a1 1 0 000 2h1v1a1 1 0 102 0V4h2v1a1 1 0 102 0V4h1a1 1 0 100-2H6zM3 8a1 1 0 011-1h12a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm2 1v8h10V9H5z"></path>
                        </svg>
                        {{ \Carbon\Carbon::parse($post->releaseDate)->format('d M Y') }}
                    </span>
                    <span class="flex items-between">
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 8H9V5a1 1 0 112 0v5z"></path>
                        </svg>
                        {{ $post->duration }} minutos
                    </span>
                </div>
                <!-- Type and Areas -->
                <div class="flex flex-wrap space-x-2 mb-4">
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">{{ $type->type }}</span>
                    @foreach ($post->filmAreas as $area)
                        <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">{{ $area->area }}</span>
                    @endforeach
                </div>
                <!-- Content -->
                <div class="prose max-w-none mb-4">
                    {!! $post->content !!}
                </div>
                <!-- Prizes -->
                @if ($post->prizes->isNotEmpty())
                    <div class="flex flex-wrap space-x-4 mb-4">
                        @foreach ($post->prizes as $prize)
                            <img src="{{ asset('assets/img/prizes/' . $prize->image) }}" alt="{{ $prize->name }}" class="w-24 h-16 object-cover rounded-lg">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Video Player -->
    @if ($post->videoLink)
        <div class="container mx-auto px-64 py-8">
            <div class="aspect-video">
                <iframe src="{{ $post->videoLink }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen class="w-full h-full rounded-lg shadow-lg"></iframe>
            </div>
        </div>
    @endif
@endsection

@section('footer')
    <x-footer />
@endsection

