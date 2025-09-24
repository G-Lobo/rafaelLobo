@extends('layouts.rafaelLobo')


@section('content')

<div class="relative bg-[url('/assets/img/bg/Background-main.webp')] bg-cover bg-center min-h-screen">

    <!-- overlay com gradiente preto -->
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/60 to-black"></div>

         <!-- Header -->

            <header class="pb-20">
            <x-headerWhite/>
            </header>

    <!-- Page -->
@foreach ($works as $work)
<div>
    <p>{{ $work->id }}</p>
    <p>{{ $work->name }}</p>
    <p>{{ $work->content }}</p>
    <p>{{ $work->link }}</p>
    <img src="{{ $work->image }}" alt="">
</div>
@endforeach

    <!--FAZER AS ALTERACOES PARA QUE EXIBA OS FILMES INSTITUCIONAIS PARA TESTE -->






            <!-- POSTER GRID -->

        </div>
    </div>
</div>
@endsection

@section('footer')
    <x-footer />
@endsection
