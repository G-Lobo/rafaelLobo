@extends('layouts.rafaelLobo')

@section('header')
<x-headerHome/>
@endsection

@section('content')



    <div class="bg-[url('/assets/img/bg/Background-01.jpg')] bg-cover min-h-screen">
    </div>
</div>
@auth
    <a href="{{route('adm.pannel')}}">painel do adm</a>
@endauth
@endsection

@section('footer')
<x-footer/>
@endsection


