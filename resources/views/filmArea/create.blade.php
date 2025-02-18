@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-semibold mb-6">Criar Área de Atuação</h1>

        <form action="/area" method="POST" class="space-y-6">
            @csrf

            <div class="mb-4">
                <label for="area" class="block text-lg font-medium">Área de atuação:</label>
                <input type="text" name="area" id="area" class="mt-1 p-2 border border-gray-300 rounded-md w-full" value="{{ old('area') }}">
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="rounded-md bg-green-600 text-white py-2 px-4 hover:bg-green-700">Criar</button>
                <a href="{{ route('blog.index') }}" class="text-blue-600 hover:text-blue-800">Voltar</a>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <x-footer/>
@endsection

