@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
    <div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Blog Posts Section -->
            <div class="p-4 border rounded-lg shadow-sm bg-gray-100">
                <h1 class="text-2xl font-semibold mb-4">Blog Posts</h1>
                <a href="{{ route('blog.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Criar nova postagem</a>
                <ul class="mt-4 space-y-2">
                    @foreach ($posts as $post)
                        <li class="flex justify-between items-center border-b pb-2">
                            <span>{{ $post->title }}</span>
                            <a href="{{ route('blog.edit', $post->id) }}"
                                class="text-sm text-blue-500 hover:underline">Editar</a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('blog.indexADM') }}" class="mt-4 inline-block text-blue-600 hover:underline">Ver todos</a>
            </div>

            <!-- Filmes Section -->
            <div class="p-4 border rounded-lg shadow-sm bg-gray-100">
                <h1 class="text-2xl font-semibold mb-4">Filmes</h1>
                <a href="{{ route('movies.create') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Criar novo filme</a>
                <ul class="mt-4 space-y-2">
                    @foreach ($movies as $movie)
                        <li class="flex justify-between items-center border-b pb-2">
                            <span>{{ $movie->title }}</span>
                            <a href="{{ route('movies.edit', $movie->id) }}"
                                class="text-sm text-green-500 hover:underline">Editar</a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('movies.indexADM') }}" class="mt-4 inline-block text-green-600 hover:underline">Ver
                    todos</a>
            </div>

            {{-- Institutional --}}
            <div class="p-4 border rounded-lg shadow-sm bg-gray-100">
                <h1 class="text-2xl font-semibold mb-4">Filmes Institucionais</h1>
                <a href="{{route('institutional.create')}}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Criar novo filme</a>
                <ul class="mt-4 space-y-2">
                    @foreach ($works as $work)
                        <li class="flex justify-between items-center border-b pb-2">
                            <span>{{ $work->name }}</span>
                            <a href="{{ route('institutional.edit', $work->id) }}"
                                class="text-sm text-green-500 hover:underline">Editar</a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('institutional.indexADM') }}" class="mt-4 inline-block text-green-600 hover:underline">Ver
                    todos</a>
            </div>

        {{-- comics --}}
        <div class="p-4 border rounded-lg shadow-sm bg-gray-100">
                <h1 class="text-2xl font-semibold mb-4">Quadrinhos</h1>
                <a href="{{ route('comic.create') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Criar novo quadrinho</a>
                <ul class="mt-4 space-y-2">
                    @foreach ($comics as $comic)
                        <li class="flex justify-between items-center border-b pb-2">
                            <span>{{ $comic->title }}</span>
                            <a href="{{ route('comic.edit', $comic->id) }}"
                                class="text-sm text-green-500 hover:underline">Editar</a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('comic.indexADM') }}" class="mt-4 inline-block text-green-600 hover:underline">Ver
                    todos</a>
            </div>
</div>

        <!-- Gerenciar Áreas -->
        <div class="flex w-full justify-evenly">
            <div class="mt-6 text-center">
                <a href="{{ route('area.index') }}"
                    class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Gerenciar Áreas</a>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('about.indexADM') }}"
                    class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Gerenciar Bio</a>
            </div>
        </div>
    </div>
    <div class="flex w-full justify-evenly">
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}"
                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Voltar para a home</a>
        </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection
