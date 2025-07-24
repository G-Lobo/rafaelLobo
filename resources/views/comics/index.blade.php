@extends('layouts.rafaelLobo')

@section('header')
<x-header-general />
@endsection

@section('content')


    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach ($comics as $comic)
        <a href="{{ route('comic.show', $comic->id)}}">

            <div class="flex bg-transparent overflow-hidden transform transition duration-300 hover:scale-105">

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-800">{{ $comic->title }}</h3>

                <!-- Description -->
                    <p class="text-gray-600 text-sm mt-4">
                        {!! \Illuminate\Support\Str::limit(strip_tags($comic->content), 252, '...') !!}
                    </p>
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection

@section('footer')
<x-footer />
@endsection
