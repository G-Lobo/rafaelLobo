@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')
<div class="max-w-4xl mx-auto p-8 bg-gray-100 shadow-lg rounded-xl mt-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">Criar Uma Nova Bio</h2>

    @if ($errors->any())
        <div class="bg-red-200 text-red-900 p-4 rounded-lg mb-6 border border-red-400">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/about" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

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
                                    //adicionar tamanhos
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
            <label for="profilePic" class="block text-lg font-medium text-gray-700">Imagem do Post:</label>
            <input type="file" id="profilePic" name="profilePic" class="w-full border p-3 rounded-lg bg-white">
        </div>

        <div>
            <label for="pdf" class="block text-lg font-medium text-gray-700">PDF:</label>
            <input type="file" id="pdf" name="pdf" class="w-full border p-3 rounded-lg bg-white">
        </div>

        <div class="flex justify-between items-center mt-6">
            <button type="submit" class="bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition font-medium shadow-lg">Criar</button>
            <a href="{{ route('adm.pannel') }}" class="text-blue-600 hover:underline font-medium">Voltar</a>
        </div>
    </form>
</div>


@endsection

@section('footer')
    <x-footer/>
@endsection
