@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @foreach ($blogPosts as $post)
        <div>

            {{ $post->title }}
            <br>
            <br>
            <button>
                <a href="{{ route('blog.edit', $post->id) }}">editar post</a>
            </button>
            <br>

            <form action="{{ route('blog.destroy', $post->id) }}" method="POST"
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
