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
    @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('link')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div>

        <form action="{{ route('blog.update', [$post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Deletar</button>
        </form>

        <form action="/blog/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Título do post:</label>
                <input type="text" name="title" id="title"
                    value="@if (old('title') == null) {{ $post->title }} @else {{ old('title') }} @endif">
            </div>

            <div>
                <label for="content">Conteúdo:</label>
                <textarea name="content" id="content" cols="30" rows="10">@if (old('content') == null) {{$post->content}} @else {{old('content')}} @endif </textarea>
            </div>
            <div>
                <label for="image">Imagem do Post:</label>
                <img src="/assets/img/blogImages/{{ $post->image }}" alt="">
                <input type="file" id="image" name="image">
            </div>

            <div>
                <label for="link">Vídeo:</label>
                <input type="text" id="link" name="link" value="@if (old('link') == null) {{$post->link}} @else {{old('link')}} @endif">
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
