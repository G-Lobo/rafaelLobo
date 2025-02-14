@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')
    <h2 class="text-4xl font-black text-start mx-auto mb-2 px-52 pt-12">FILMES</h2>
    <div class="container mx-auto px-4 pt-4 pb-32">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($movies as $movie)
            <a href="{{ route('movies.show', $movie->id)}}">
                <div class="flex bg-transparent rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                    <!-- Movie Cover Art -->
                    <img src="{{ asset('assets/img/coverArts/' . $movie->coverArt) }}" alt="{{ $movie->title }}" class="w-1/3 object-cover">

                    <!-- Movie Details -->
                    <div class="w-2/3 p-4 flex flex-col justify-between">
                        <!-- Title -->
                        <h3 class="text-xl font-semibold text-gray-800">{{ $movie->title }}</h3>

                        <!-- Tags -->
                        <div class="flex flex-wrap space-x-2 mt-2">
                            <div>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ \Carbon\Carbon::parse($movie->releaseDate)->format('Y') }}</span>
                                <span class="bg-transparent text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $movie->duration }} min</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap space-x-2 mt-2">
                            @foreach($movie->filmAreas as $area)
                                <span class="bg-blue-800 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $area->area }}</span>
                            @endforeach
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mt-4">
                            {{ \Illuminate\Support\Str::limit($movie->content, 250, '...') }}
                        </p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection

@section('footer')
    <x-footer/>
@endsection
