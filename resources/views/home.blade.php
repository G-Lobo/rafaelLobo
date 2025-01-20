@extends('layouts.rafaelLobo')

@section('header')
<x-headerHome/>
@endsection

@section('content')

@auth
    <a href="{{route('adm.pannel')}}">painel do adm</a>
@endauth
<div class="bg-[url('/assets/img/bg/Background-01.jpg')]">

</div>














@endsection

@section('footer')
footer
@endsection
