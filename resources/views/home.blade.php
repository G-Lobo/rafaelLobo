@extends('layouts.rafaelLobo')

@section('header')
header
@endsection

@section('content')

@auth
    <a href="{{route('adm.pannel')}}">painel do adm</a>
@endauth















@endsection

@section('footer')
footer
@endsection
