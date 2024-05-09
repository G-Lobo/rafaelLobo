@extends('layouts.rafaelLobo')

@section('header')
header
@endsection

@section('content')
create

<form action="/filmes" method="POST" enctype="multipart/form-data">
@csrf
<div>
    <label for="title">Título do filme:</label>
    <input type="text" name="title" id="title">
</div>

<div>
    <label for="duration">Duração do filme em minutos:</label>
    <input type="number" name="duration" id="duration">
</div>

<div>
    <label for="content">Conteúdo:</label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
</div>

<div>
    <label for="coverArt">Capa do filme:</label>
    <input type="file" id="coverArt" name="coverArt">
</div>

<div>
    <label for="prizes">Premios do filme:</label>
    <input type="file" id="prizes" name="prizes[]" multiple>
</div>

<div>
    <label for="releaseDate">Data de lançamento do filme:</label>
    <input type="date" id="releaseDate" name="releaseDate">
</div>

<div>
    <label for="link">Link do filme:</label>
    <input type="text" id="link" name="link" placeholder="link vimeo ou youtube">
</div>

<div>

    <button type="submit" class="rounded-md bg-green-600">criar</button>
<a href="{{route('blog.index')}}">voltar</a>
</div>

</form>



@endsection

@section('footer')
footer
@endsection
