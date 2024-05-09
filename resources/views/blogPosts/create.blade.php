@extends('layouts.rafaelLobo')

@section('header')
header
@endsection

@section('content')
create

<form action="/blog" method="POST" enctype="multipart/form-data">
@csrf
<div>
    <label for="title">Título do post:</label>
    <input type="text" name="title" id="title">
</div>

<div>
    <label for="content">Conteúdo:</label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
</div>
<div>
    <label for="image">Imagem do Post:</label>
    <input type="file" id="image" name="image">
</div>

<div>
    <label for="link">Vídeo:</label>
    <input type="text" id="link" name="link">
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
