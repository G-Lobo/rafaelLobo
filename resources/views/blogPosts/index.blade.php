@extends('layouts.rafaelLobo')

@section('header')
    header
@endsection

@section('content')
    index

    @foreach ($blogPosts as $post)
        <br>
        {{ $post->title }}
        <br>

        <img src="assets/img/blogImages/{{ $post->image }}" alt="">

        <br>
    @endforeach
@endsection

@section('footer')
    footer
@endsection
