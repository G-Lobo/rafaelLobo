@extends('layouts.rafaelLobo')

@section('header')
    <header class="bg-blue-700 text-white p-6 text-center text-2xl font-extrabold shadow-md">
        Painel de Administração
    </header>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto p-8 bg-gray-100 shadow-lg rounded-xl mt-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Criar Novo Post</h2>

        @if ($errors->any())
            <div class="bg-red-200 text-red-900 p-4 rounded-lg mb-6 border border-red-400">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/blog" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Título do Post:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
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
                                        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
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
                <label for="image" class="block text-lg font-medium text-gray-700">Imagem do Post:</label>
                <input type="file" id="image" name="image" class="w-full border p-3 rounded-lg bg-white">
            </div>

            <div>
                <label for="pdf" class="block text-lg font-medium text-gray-700">PDF:</label>
                <input type="file" id="pdf" name="pdf" class="w-full border p-3 rounded-lg bg-white">
            </div>

            <div>
                <label for="link" class="block text-lg font-medium text-gray-700">Vídeo:</label>
                <input type="text" id="link" name="link" value="{{ old('link') }}"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white shadow-sm">
            </div>

            <div class="flex justify-between items-center mt-6">
                <button type="submit" class="bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition font-medium shadow-lg">Criar</button>
                <a href="{{ route('blog.index') }}" class="text-blue-600 hover:underline font-medium">Voltar</a>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <footer class="bg-blue-700 text-white text-center p-6 mt-8 shadow-md text-lg font-semibold">
        © 2025 Painel de Administração
    </footer>
@endsection
