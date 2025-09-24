@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg my-8">

        {{-- Error messages --}}
        @foreach (['title', 'releaseDate', 'content'] as $error)
            @error($error)
                <div class="alert alert-danger text-red-500 font-medium mb-4">
                    {{ $message }}
                </div>
            @enderror
        @endforeach

        <form action="{{ route('collage.destroy', [$post->id]) }}" method="POST" class="mb-6" onsubmit="return confirm('Tem certeza que deseja deletar este item?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                Deletar
            </button>
        </form>

        <form action="/art/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="flex flex-col">
                <label for="title" class="text-lg font-medium mb-2">Título:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Release Date -->
            <div class="flex flex-col">
                <label for="releaseDate" class="text-lg font-medium mb-2">Data de lançamento do filme:</label>
                <input type="date" id="releaseDate" name="releaseDate" value=""
                    class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Content (Quill Editor) -->
            <div>
                <label for="content" class="block text-lg font-medium text-gray-700">Conteúdo:</label>
                <div id="quill-editor" class="h-48 border rounded-lg bg-white p-3"></div>
                <textarea name="content" id="quill-editor-area" class="hidden">{{ old('content', $post->content) }}</textarea>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var quillEditorArea = document.getElementById('quill-editor-area');

                        if (quillEditorArea) {
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

                            // Carregar o conteúdo salvo no Quill Editor
                            var content = quillEditorArea.value;
                            editor.root.innerHTML = content;

                            // Atualizar textarea oculto ao digitar no Quill
                            editor.on('text-change', function() {
                                quillEditorArea.value = editor.root.innerHTML;
                            });

                            // Se o usuário editar o textarea diretamente, atualizar o Quill
                            quillEditorArea.addEventListener('input', function() {
                                editor.root.innerHTML = quillEditorArea.value;
                            });
                        }
                    });
                </script>
            </div>


            <!-- Prizes -->
            <div class="flex flex-col">
                <label for="prizes" class="text-lg font-medium mb-2">Prêmios do Filme:</label>
                <div class="mb-4">
                    @foreach ($post->collection as $collection)
                        <img src="/assets/img/prizes/{{ $collection->image }}" alt="Premio" class="w-24 h-24 object-cover rounded-md shadow-md">
                    @endforeach
                </div>
                <input type="file" id="collection" name="collection[]" multiple class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-between mt-6">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    Atualizar
                </button>
                <a href="{{ route('blog.index') }}" class="px-6 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                    Voltar
                </a>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <x-footer/>
@endsection
