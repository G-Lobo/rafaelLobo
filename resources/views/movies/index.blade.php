@extends('layouts.rafaelLobo')


@section('content')

<div class="relative min-h-screen">

    <!-- overlay com gradiente preto -->
    <x-background-image :overlay="true" />

         <!-- Header -->

            <header class="pb-20">
            <x-headerWhite/>
            </header>

    <!-- Page -->

    <div class="relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">


            <!-- Title -->
            <div class="text-center mb-12">
                <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight text-white">
                    Filmes
                </h1>
                <p class="mt-2 text-lg lg:text-xl text-gray-300">
                    Filmes Autorais
                </p>
            </div>

            <!-- Filtro de Área (Desativado) -->

            <!--
            <div class="flex justify-center mb-12">
                <form method="GET" action="{{ route('movies.index') }}" class="flex items-center space-x-3 bg-white/10 backdrop-blur-sm p-4 rounded-lg">
                    <label for="area_id" class="text-sm font-medium text-white">Filtrar por:</label>
                    <select name="area_id" id="area_id" onchange="this.form.submit()" class="block w-full md:w-auto px-3 py-2 border border-gray-500 bg-gray-800 text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Todas as Áreas</option>
                        {{-- @foreach($filmAreas as $area)
                            <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                                {{ $area->area }}
                            </option>
                        @endforeach --}}
                    </select>
                </form>
            </div>
            -->


            <!-- POSTER GRID -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-12">
                @foreach ($movies as $movie)
                    <!-- POSTER CARD-->
                    <a href="{{ route('movies.show', $movie->id) }}" class="group block">
                        <!-- POSTER CONTAINTER -->
                        <div class="w-full aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden shadow-2xl transition-transform duration-300 ease-in-out group-hover:scale-105">
                            <img src="{{ asset('assets/img/coverArts/' . $movie->coverArt) }}" alt="Pôster do filme {{ $movie->title }}"
                                class="w-full h-full object-cover object-center">
                        </div>

                        <!-- Informações centralizadas abaixo do pôster -->
                        <div class="mt-4 text-white text-center">
                            <h3 class="font-bold text-lg truncate" title="{{ $movie->title }}">{{ $movie->title }}</h3>

                            <!-- Linha de informações: Tipo e Duração -->
                            <div class="flex justify-center items-center space-x-2 text-sm text-gray-300 mt-1">
                                <span>{{ $movie->duration }} min</span>
                            </div>

                                 <!-- Tipo e Áreas de Atuação -->
                {{-- <div class="flex flex-wrap justify-center md:justify-center gap-2 mb-8">

                <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">{{ $area->area }}</span>

                </div> --}}
                        </div>
                    </a>
                @endforeach
            </div>


            <div class="text-center mb-12">
                <p class="mt-2 text-lg lg:text-xl text-gray-300">
                    Filmes Institucionais
                </p>
            </div>


            <div class="grid grid-cols-1 gap-x-6 gap-y-12">
                @foreach ($institutionals as $inst)
                    <!-- POSTER CARD-->
                    <a href="{{$inst->link}}" class="group flex flex-col gap-4 md:flex-row">
                        <!-- POSTER CONTAINTER -->
                        <div class="w-full md:w-1/2 aspect-video bg-gray-800 rounded-lg overflow-hidden shadow-2xl">
                            <img src="{{ asset('assets/img/institucional/' . $inst->image) }}" alt="Pôster do filme {{ $inst->name }}"
                            class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                        </div>

                        <!-- Informações centralizadas abaixo do pôster -->
                        <div class="mt-4 text-white w-full md:w-1/2 flex flex-col justify-center">
                            <h3 class="font-bold text-lg" title="{{ $inst->name }}">{{ $inst->name }}</h3>
                            <p>{{ strip_tags($inst->content) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>









        </div>




    </div>
</div>
@endsection

@section('footer')
    <x-footer />
@endsection
