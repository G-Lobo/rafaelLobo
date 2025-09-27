@extends('layouts.rafaelLobo')


@section('content')
<div class="relative min-h-screen">
    <x-background-image :overlay="true" />

    <!-- Header -->

    <header class="pb-20">
        <x-headerWhite/>
    </header>
    <div class="container mx-auto px-4 pt-16 pb-32 relative z-10 grid grid-cols-1 gap-x-6 gap-y-12 md:grid-cols-2 xl:grid-cols-4">
        @foreach ($comics as $comic)
        <a href="{{ route('comic.show', $comic->id)}}" class="group flex flex-col gap-4">
            <div class="w-full aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden shadow-2xl">
                <img src="{{ asset('assets/img/comicCovers/' . $comic->coverImg) }}" alt="" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
            </div>
            <div class="mt-4 text-white w-full flex flex-col justify-center">
                <h3 class="font-bold text-lg text-center" title="{{ $comic->title }}">{{ $comic->title }}</h3>
                <p class="line-clamp-4">{{ strip_tags($comic->content) }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection

@section('footer')
<x-footer />
@endsection
