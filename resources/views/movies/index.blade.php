@extends('layouts.rafaelLobo')

@section('header')
<x-header-general />
@endsection

@section('content')



<div class="container mx-auto px-5 xl:px-32 xl:pr-16 pt-4 pb-16">
    <h2 class="text-4xl font-black text-center xl:text-left mx-auto mb-2 pt-8 pb-8">FILMES</h2>

    <div class="flex flex-start place-content-center xl:place-content-start">
        <form method="GET" action="{{ route('movies.index') }}" class="flex items-center mx-0 mb-6">
            <label for="area_id" class="text-base font-bold text-black text-center">Filtrar por Área:</label>
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
        <p>{{ $movie->title }}</p>
        @endforeach
    </div>

</div>
@endsection

@section('footer')
<x-footer />
@endsection