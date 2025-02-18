@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')



<div class="container mx-auto px-32 pr-16 pt-4 pb-16">
    <h2 class="text-4xl font-black text-start mx-auto mb-2 pt-8 pb-8">FILMES</h2>

    <div class="flex flex-start">
    <form method="GET" action="{{ route('movies.index') }}" class="flex items-center mx-0 mb-6">
        <label for="area_id" class="text-base font-bold text-black">Filtrar por Área:</label>
        <select name="area_id" id="area_id" onchange="this.form.submit()" class="block w-full md:w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="">Todas as Áreas</option>
            @foreach($filmAreas as $area)
                <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                    {{ $area->area }}
                </option>
            @endforeach
        </select>
    </form>
    </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach ($movies as $movie)
            <a href="{{ route('movies.show', $movie->id)}}">
                <div class="flex bg-transparent overflow-hidden transform transition duration-300 hover:scale-105">
                    <!-- Movie Cover Art -->
                    <img src="{{ asset('assets/img/coverArts/' . $movie->coverArt) }}" alt="{{ $movie->title }}" class="w-1/3 object-cover rounded-lg">

                    <!-- Movie Details -->
                    <div class="w-2/3 p-4 flex flex-col justify-start">
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-800">{{ $movie->title }}</h3>

                        <!-- Tags -->
                        <div class="flex flex-wrap space-x-2 mt-">
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
