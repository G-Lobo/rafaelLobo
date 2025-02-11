@extends('layouts.rafaelLobo')

@section('header')
header
@endsection

@section('content')
edit


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

<div>

    <form action="{{ route('movies.destroy', [$post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>

    <form action="/filmes/{{$post->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Título do filme:</label>
            <input type="text" name="title" id="title" value="@if (old('title') == null) {{ $post->title }} @else {{old('title')}} @endif">
        </div>

        <div>
            <label for="duration">Duração do filme em minutos:</label>
            <input type="number" name="duration" id="duration" value="@if (old('duration') == null) {{ $post->duration }} @else {{old('duration')}} @endif">
        </div>

        <div>
            <label for="releaseDate">Data de lançamento do filme:</label>
            <input type="date" id="releaseDate" name="releaseDate" value="@if (old('releaseDate') == null) {{$post->releaseDate}} @else {{old('releaseDate')}} @endif">
        </div>

        <div>
            <label for="content">Conteúdo:</label>
            <textarea name="content" id="content" cols="30" rows="10">@if (old('content') == null) {{ $post->content }} @else {{old('content')}} @endif</textarea>
        </div>
        <div>
            <label for="coverArt">Imagem do Post:</label>
            <img src="/assets/img/coverArts/{{ $post->coverArt }}" alt="">
            <input type="file" id="coverArt" name="coverArt">
        </div>

        <div>
            <label for="prizes">Premios do Filme:</label>
            @foreach ($post->prizes as $prize)
                <img src="/assets/img/prizes/{{ $prize->image }}" alt="">
            @endforeach
            <input type="file" id="image" name="prizes[]" multiple>
        </div>

        <div>
            <label for="link">Link do filme:</label>
            <input type="text" id="link" name="link" placeholder="link vimeo ou youtube" value="@if (old('link') == null) {{$post->link}} @else {{old('link')}} @endif">
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

        <div>

            <button type="submit" class="rounded-md bg-green-600">criar</button>
            <a href="{{ route('blog.index') }}">voltar</a>
        </div>

    </form>
</div>


@endsection

@section('footer')
footer
@endsection
