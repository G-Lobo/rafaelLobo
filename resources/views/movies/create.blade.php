@extends('layouts.rafaelLobo')

@section('header')
    <header class="bg-blue-700 text-white p-6 text-center text-2xl font-extrabold shadow-md">
        Painel de Administração
    </header>
@endsection

@section('content')
    <div class="max-w-5xl mx-auto p-8 bg-gray-100 shadow-lg rounded-xl mt-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Criar Novo Filme</h2>

        @if ($errors->any())
            <div class="bg-red-200 text-red-900 p-4 rounded-lg mb-6 border border-red-400">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/filmes" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Título do filme:</label>
                <input type="text" name="title" id="title" value="{{old('title')}}"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-sm">
            </div>

            <div>
                <label for="duration" class="block text-lg font-medium text-gray-700">Duração (minutos):</label>
                <input type="number" name="duration" id="duration" value="{{old('duration')}}"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-sm">
            </div>

            <div>
                <label for="content" class="block text-lg font-medium text-gray-700">Conteúdo:</label>
                <div id="quill-editor" class="h-48 border rounded-lg bg-white p-3"></div>
                <textarea name="content" id="quill-editor-area" class="hidden">{{ old('content') }}</textarea>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        if (document.getElementById('quill-editor-area')) {
                            var editor = new Quill('#quill-editor', {
                                modules: {
                                    toolbar: [
                                        ['bold', 'italic', 'underline', 'strike'],
                                        ['link', 'blockquote', 'align'],
                                        [{
                                            list: 'ordered'
                                        }, {
                                            list: 'bullet'
                                        }],
                                    ],
                                },
                                theme: 'snow'
                            });
                            var quillEditor = document.getElementById('quill-editor-area');
                            editor.on('text-change', function() {
                                quillEditor.value = editor.root.innerHTML;
                            });

                            quillEditor.addEventListener('input', function() {
                                editor.root.innerHTML = quillEditor.value;
                            });
                        }
                    });
                </script>
            </div>

            <div>
                <label for="coverArt" class="block text-lg font-medium text-gray-700">Capa do filme:</label>
                <input type="file" id="coverArt" name="coverArt" class="w-full border p-3 rounded-lg bg-white">
            </div>

            <div>
                <label for="prizes" class="block text-lg font-medium text-gray-700">Prêmios:</label>
                <input type="file" id="prizes" name="prizes[]" multiple class="w-full border p-3 rounded-lg bg-white">
            </div>

            <div>
                <label for="releaseDate" class="block text-lg font-medium text-gray-700">Data de lançamento:</label>
                <input type="date" id="releaseDate" name="releaseDate" value="{{old('releaseDate')}}"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-sm">
            </div>

            <div>
                <label for="link" class="block text-lg font-medium text-gray-700">Link do filme:</label>
                <input type="text" id="link" name="link" placeholder="Vimeo ou YouTube" value="{{old('link')}}"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-sm">
            </div>

            <div>
                <label for="typeId" class="block text-lg font-medium text-gray-700">Tipo do filme:</label>
                <select id="typeId" name="typeId" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-sm">
                    @foreach ($filmTypes as $filmType)
                        <option value="{{ $filmType->id }}">{{ $filmType->type }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="film_areas" class="block text-lg font-medium text-gray-700">Áreas de Participação:</label>
                <select name="film_areas[]" id="film_areas" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-sm" multiple>
                    @foreach($filmAreas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between items-center mt-6">
                <button type="submit" class="bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition font-medium shadow-lg">Criar</button>
                <a href="{{route('blog.index')}}" class="text-blue-600 hover:underline font-medium">Voltar</a>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <footer class="bg-blue-700 text-white text-center p-6 mt-8 shadow-md text-lg font-semibold">
        © 2025 Painel de Administração
    </footer>
@endsection
