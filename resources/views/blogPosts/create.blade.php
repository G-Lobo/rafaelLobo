@extends('layouts.rafaelLobo')

@section('header')
    header
@endsection

@section('content')
    create


    {{-- mensagens de erro das validaçoes --}}

    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('link')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror


    <form action="/blog" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Título do post:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">

        </div>

        <div>
            <label for="content">Conteúdo:</label>
            <div id="quill-editor" class="mb-3" style="height: 300px;">
            </div>
            <textarea rows="3" class="mb-3 hidden" name="content" id="quill-editor-area">{{ old('content') }}</textarea>
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
            <label for="image">Imagem do Post:</label>
            <input type="file" id="image" name="image" value="{{ old('image') }}">
        </div>

        <div>
            <label for="pdf">pdf:</label>
            <input type="file" id="pdf" name="pdf" value="{{ old('pdf') }}">
        </div>

        <div>
            <label for="link">Vídeo:</label>
            <input type="text" id="link" name="link" value="{{ old('link') }}">
        </div>

        <div>

            <button type="submit" class="rounded-md bg-green-600">criar</button>
            <a href="{{ route('blog.index') }}">voltar</a>
        </div>

    </form>
@endsection

@section('footer')
    footer
@endsection
