@extends('layouts.rafaelLobo')


@section('content')
<div class="relative bg-[url('/assets/img/bg/Background-main.webp')] bg-cover bg-center min-h-screen">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/60 to-black"></div>

    <!-- Header -->

    <header class="pb-20">
        <x-headerWhite/>
    </header>
    <div class="container mx-auto px-4 pt-16 pb-32 relative z-10 grid grid-cols-1 gap-x-6 gap-y-12">
        @foreach ($comics as $comic)
        <a href="{{ route('comic.show', $comic->id)}}" class="group flex flex-col gap-4 md:flex-row">
            <div class="w-full md:w-1/2 aspect-video bg-gray-800 rounded-lg overflow-hidden shadow-2xl">
                <img src="{{ asset('assets/img/comicCovers/' . $comic->coverImg) }}" alt="" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
            </div>
            <div class="mt-4 text-white w-full md:w-1/2 flex flex-col justify-center">
                <h3 class="font-bold text-lg" title="{{ $comic->title }}">{{ $comic->title }}</h3>
                <p>{!! $comic->content !!}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection

@section('footer')
<x-footer />
@endsection
