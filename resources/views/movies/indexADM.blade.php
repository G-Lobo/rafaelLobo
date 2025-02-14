@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
    index

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @foreach ($movies as $movie)
        <div>
            {{ $movie->title }}

            <br>
            <br>
            <button>
                <a href="{{ route('movies.edit', $movie->id) }}">editar filme</a>
            </button>
            <br>
            <img src="{{asset('assets/img/coverArts/' . $movie->coverArt)}}" alt="">


            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST"
                onselect="confirm('Tem certeza que deseja deletar este item?');">
                @csrf
                @method('DELETE')
                <button type="submit">Deletar</button>
            </form>

        </div>
    @endforeach
@endsection

@section('footer')
    <x-footer />
@endsection
