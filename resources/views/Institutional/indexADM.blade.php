@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
    <div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold mb-6">Lista de Filmes</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($works as $work)
                <div class="p-4 border rounded-lg shadow-sm bg-gray-100">
                    <h2 class="text-xl font-semibold">{{ $work->name }}</h2>
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('institutional.edit', $work->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Editar</a>
                        <form action="{{ route('institutional.destroy', $work->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Deletar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection
