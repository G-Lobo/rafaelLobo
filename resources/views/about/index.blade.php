@extends('layouts.rafaelLobo')

{{-- @section('header')
    <x-header-general />
@endsection --}}

@section('content')
    <style>
        .prose * {
            color: white !important
        }
    </style>
    <div class="relative min-h-screen">

        <x-background-image :overlay="true" />

        <header class="pb-20">
            <x-headerWhite />
        </header>

        <div class="relative z-10">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">




                @foreach ($bio as $bio)
                    <div class="bg-transparent pt-24 pb-16 relative z-10">
                        <div class="container mx-auto px-4 sm:px-8 md:px-16 xl:px-56">
                            <div class="flex flex-col md:flex-row items-center space-y-8 md:space-y-0 md:space-x-12">
                                <!-- Text Content -->
                                {{-- Usando as classes 'prose' e 'prose-invert' para estilizar o conteúdo HTML para fundos escuros --}}
                                <div class="w-full md:w-2/3 prose xl:prose-invert">
                                    {!! $bio->content !!}
                                </div>
                                <!-- Profile Picture with CV Box -->
                                <div class="w-full md:w-1/3 flex flex-col justify-center relative">
                                    <!-- Profile Picture -->
                                    <img src="{{ asset('assets/img/profPic/' . $bio->profilePic) }}" alt="Rafael Lobo"
                                        class="rounded-lg shadow-lg w-256 h-256 object-cover mx-auto">
                                    <!-- CV Box -->
                                    <div class="pt-4 flex justify-between">
                                        <div>
                                            <x-social-icons-white />
                                        </div>
                                        <div>
                                            <a href="{{ asset('assets/pdf/bio/' . $bio->pdf) }} " target="_blank"
                                                rel=""
                                                class="absolute right-0 bg-red-500 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-gray-200 hover:text-red-500 transition duration-300">
                                                CV
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="relative z-10">
                    {{-- Trabalhos Recentes (Mobile) --}}
                    <div class="xl:hidden">
                        <h2 class="text-3xl font-black text-center mb-4 text-white">Trabalhos Recentes</h2>
                        <div class="container mx-auto px-4 pt-16 pb-32">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                @foreach ($movies as $movie)
                                    <a href="{{ route('movies.show', $movie->id) }}">
                                        <div
                                            class="flex flex-col items-center bg-gray-200 rounded-lg shadow-xl overflow-hidden transform transition duration-300 hover:scale-105">
                                            <div class="p-4">
                                                {{-- Título do filme (agora preto, pois o card é claro) --}}
                                                <h3 class="text-xl font-semibold text-center text-gray-800">
                                                    {{ $movie->title }}</h3>
                                            </div>
                                            <div class="w-256 h-180">
                                                <img src="{{ asset('assets/img/coverArts/' . $movie->coverArt) }}"
                                                    alt="{{ $movie->title }}" class="w-256 h-full object-cover">
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Trabalhos Recentes (Desktop) --}}
                    <div class="hidden xl:inline">
                        <h2 class="text-4xl font-black text-center mb-4 text-white">Trabalhos Recentes</h2>
                        <div class="container mx-auto px-56 pt-16 pb-32">
                            <div class="flex flex-col space-y-8">
                                @foreach ($movies as $movie)
                                    <a href="{{ route('movies.show', $movie->id) }}">
                                        <div
                                            class="flex items-center overflow-hidden transform transition duration-300 hover:scale-105">
                                            <div class="h-48 ">
                                                <img src="{{ asset('assets/img/coverArts/' . $movie->coverArt) }}"
                                                    alt="{{ $movie->title }}"
                                                    class="w-full h-full object-cover object-scale-down">
                                            </div>
                                            <div class="flex-1 p-4 px-8">
                                                <h3 class="text-xl font-semibold text-white">{{ $movie->title }}</h3>
                                                <div class="my-2 text-gray-300">
                                                    {!! Str::limit(strip_tags($movie->content), 550, '...') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- horizontal line -->
                                    <div>
                                        <hr class="border-gray-600 my-4">
                                        </hr>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection
