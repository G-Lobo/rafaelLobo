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

    @foreach ($movies as $movie)
        <br>
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
    @endforeach
@endsection

@section('footer')
    footer
@endsection
