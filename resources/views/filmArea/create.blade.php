@extends('layouts.rafaelLobo')

@section('header')
header
@endsection

@section('content')
create


<form action="/area" method="POST">
@csrf
<div>
    <label for="title">Área de atuação:</label>
    <input type="text" name="area" id="area" value="{{old('area')}}">
</div>


    <button type="submit" class="rounded-md bg-green-600">criar</button>
<a href="{{route('blog.index')}}">voltar</a>
</div>

</form>



@endsection

@section('footer')
footer
@endsection
