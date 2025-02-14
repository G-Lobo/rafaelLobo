@extends('layouts.rafaelLobo')

@section('header')
<x-header-general/>
@endsection

@section('content')


Blog Posts

<a href="{{ route('blog.create') }}">Criar nova postagem</a>
<br>
<a href="{{ route('blog.indexADM') }}">Ver todos</a>
@foreach ($posts as $post)
    {{$post->title}}
    <a href="{{route('blog.edit', $post->id)}}">editar</a>

    <br>
@endforeach


Filmes

<a href="{{ route('movies.create') }}">Criar novo filme</a>
<br>
<a href="{{ route('movies.indexADM') }}">Ver todos</a>
@foreach ($movies as $movie)
    {{$movie->title}}
    <a href="{{route('movies.edit', $movie->id)}}">editar</a>
    <br>

@endforeach


<a href="{{ route('area.index') }}">areas</a>


@endsection

@section('footer')
    <x-footer/>
@endsection
