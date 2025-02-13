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

    @foreach ($blogPosts as $post)
        <br>
        {{ $post->title }}
        <br>
        {{ $post->content }}
        <br>
        <iframe src="{{$post->video}}" frameborder="0"></iframe>
        <br>

        <img src="assets/img/blogImages/{{ $post->image }}" alt="">

        <br>
    @endforeach
    <div>
        {{-- Links da Paginação --}}
        {{$blogPosts->links()}}
    </div>
    @endsection

@section('footer')
    footer
@endsection
