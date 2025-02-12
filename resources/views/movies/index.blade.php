@extends('layouts.rafaelLobo')

@section('header')
    header
@endsection

@section('content')
    index

    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif
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
    <br>
        {{ $movie->id }}
        {{ $movie->title }}
        <br>
        {{$movie->releaseDate}}
        <br>
        {{$movie->content}}
        <br>
        {{$movie->duration}}
        <br>
        <iframe src="{{$movie->videoLink}}" width="640" height="360"
    frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>


        <img src="assets/img/coverArts/{{ $movie->coverArt }}" alt="">

        <br>
    </div>
    @endforeach
@endsection

@section('footer')
    footer
@endsection
