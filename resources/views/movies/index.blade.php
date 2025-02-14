@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')
    index


<form method="GET" action="{{ route('movies.index') }}">
    <label for="area_id">Filtrar por Área:</label>
    <select name="area_id" id="area_id" onchange="this.form.submit()">
        <option value="">Todas as Áreas</option>
        @foreach($filmAreas as $area)
            <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                {{ $area->area }}
            </option>
        @endforeach
    </select>
</form>


    @foreach ($movies as $movie)
        <div>
            <a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a>


        {{$movie->releaseDate}}
        @foreach ($movie->filmAreas as $area)
        <p>{{ $area->area }}</p>
    @endforeach

        <img src="assets/img/coverArts/{{ $movie->coverArt }}" alt="">


    </div>
    @endforeach
@endsection

@section('footer')
    <x-footer/>
@endsection
