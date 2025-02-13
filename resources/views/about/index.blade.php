@extends('layouts.rafaelLobo')

@section('header')
    header
@endsection

@section('content')

trabalhos recentes


@foreach ($movies as $movie)
<p>{{ $movie->title }}</p>
<img src="assets/img/coverArts/{{ $movie->coverArt }}" alt="">
<p>{{ $movie->title }}</p>
<p>{{ $movie->title }}</p>
@foreach($movie->filmAreas as $area)
    <p>{{ $area->area }}</p>
@endforeach
@endforeach




@endsection

@section('footer')
    footer

@endsection
