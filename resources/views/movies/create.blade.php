@extends('layouts.rafaelLobo')

@section('header')
header
@endsection

@section('content')
create


{{-- mensagens de erro das validaçoes --}}
@error('title')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('releaseDate')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('content')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('coverArt')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('duration')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('link')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('typeId')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('film_areas')
<div class="alert alert-danger">{{ $message }}</div>
@enderror


<form action="/filmes" method="POST" enctype="multipart/form-data">
@csrf
<div>
    <label for="title">Título do filme:</label>
    <input type="text" name="title" id="title" value="{{old('title')}}">
</div>

<div>
    <label for="duration">Duração do filme em minutos:</label>
    <input type="number" name="duration" id="duration" value="{{old('duration')}}">
</div>

<div>
    <label for="content">Conteúdo:</label>
    <textarea name="content" id="content" cols="30" rows="10">{{old('content')}}</textarea>
</div>

<div>
    <label for="coverArt">Capa do filme:</label>
    <input type="file" id="coverArt" name="coverArt" value="{{old('coverArt')}}">
</div>

<div>
    <label for="prizes">Premios do filme:</label>
    <input type="file" id="prizes" name="prizes[]" multiple value="{{old('prizes')}}">
</div>

<div>
    <label for="releaseDate">Data de lançamento do filme:</label>
    <input type="date" id="releaseDate" name="releaseDate" value="{{old('releaseDate')}}">
</div>

<div>
    <label for="link">Link do filme:</label>
    <input type="text" id="link" name="link" placeholder="link vimeo ou youtube" value="{{old('link')}}">
</div>

<div>
    <label for="link">Tipo do filme:</label>
    <select id="typeId" name="typeId" placeholder="Curta" value="{{old('typeId')}}">
        @foreach ($filmTypes as $filmType)
            <option value="{{ $filmType->id }}">{{ $filmType->type }}</option>
        @endforeach
        </select>
</div>

<div class="form-group">
    <label for="film_areas">Áreas de Participação</label>
    <select name="film_areas[]" id="film_areas" class="form-control" multiple>
        @foreach($filmAreas as $area)
            <option value="{{ $area->id }}">{{ $area->area }}</option>
        @endforeach
    </select>
</div>

{{--
<div>
    <label for="areaId">Area de atuacao do filme:</label>
    <select multiple id="areaId" name="areaIds[]" placeholder="Diretor" value="{{old('areaId')}}" class="w-32">
        @foreach ($filmAreas as $area)
            <option value="{{ $area->id }}">{{ $area->area }}</option>
        @endforeach
        </select>
</div>
--}}
<div>

    <button type="submit" class="rounded-md bg-green-600">criar</button>
<a href="{{route('blog.index')}}">voltar</a>
</div>


</form>



@endsection

@section('footer')
footer
@endsection
