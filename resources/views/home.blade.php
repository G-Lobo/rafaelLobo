@extends('layouts.rafaelLobo')

@section('header')
<x-headerHome/>
@endsection

@section('content')

@auth
    <a href="{{route('adm.pannel')}}">painel do adm</a>
@endauth















@endsection

@section('footer')
footer
@endsection
