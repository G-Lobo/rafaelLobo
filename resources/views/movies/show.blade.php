@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')
    index

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <div class="mx-64">

        <div class="grid grid-cols-5 grid-rows-[0.5fr_repeat(4,_1fr)] gap-0">

            <!-- titulo -->
            <div class="col-span-2 row-span-1 text-5xl">
                <h1 class="">
                    {{ $post->title }}
                </h1>
            </div>

            <!-- poster -->
            <div class="col-span-2 row-span-4">
                <img src="/assets/img/coverArts/{{ $post->coverArt }}" alt="" class="min-w-36">
            </div>

            <!-- texto -->
            <div class="col-span-3 row-span-3 col-start-3 row-start-3">
                {!! $post->content !!}
            </div>

            <!-- data e duraçao -->
            <div class="col-span-1 row-span-1 col-start-3 row-start-2">
                <p>{{ $post->releaseDate }}</p>

                <p> {{ $post->duration }} minutos </p>
            </div>

            <!-- tipo e area -->
            <div class="col-span-1 row-span-1 col-start-4 row-start-2">
                <p> {{ $type->type }} </p>

                @foreach ($post->filmAreas as $area)
                    <p>{{ $area->area }}</p>
                @endforeach
            </div>
        </div>

    <div class="my-8">
        {{-- premios do filme --}}
        {{-- adicionar um if para caso nao tenha premios --}}
        <div>
            @foreach ($post->prizes as $prize)
            <img src="{{ asset('assets/img/prizes/' . $prize->image) }}" alt="">
            @endforeach
        </div>

        {{-- player do video --}}
        <div>
            <iframe src="{{ $post->videoLink }}" frameborder="0"></iframe>
        </div>
    </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection
