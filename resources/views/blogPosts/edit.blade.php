@extends('layouts.rafaelLobo')

@section('header')
    header
@endsection

@section('content')
    edit


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

    <div>

        <form action="{{ route('blog.update', [$post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Deletar</button>
        </form>

        <form action="/blog/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Título do post:</label>
                <input type="text" name="title" id="title"
                    value="@if (old('title') == null) {{ $post->title }} @else {{ old('title') }} @endif">
            </div>

            <div>
                <div>
                    <label for="content">Conteúdo:</label>
                    <!-- Editor Quill -->
                    <div id="quill-editor" class="mb-3" style="height: 300px;"></div>
                    <!-- Input oculto para armazenar o valor do Quill -->
                    <textarea name="content" id="quill-editor-area" class="hidden">{{ old('content', $post->content) }}</textarea>
                </div>
                <!-- QuillJS e Script -->
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

            <div>
                <label for="image">Imagem do Post:</label>
                <img src="/assets/img/blogImages/{{ $post->image }}" alt="">
                <input type="file" id="image" name="image">
            </div>

            <div>
                <label for="pdf">pdf:</label>
                <input type="file" id="pdf" name="pdf" value="{{old('pdf')}}">
            </div>

            <div>
                <label for="link">Vídeo:</label>
                <input type="text" id="link" name="link" value="@if (old('link') == null) {{$post->link}} @else {{old('link')}} @endif">
            </div>

            <div>

                <button type="submit" class="rounded-md bg-green-600">criar</button>
                <a href="{{ route('blog.index') }}">voltar</a>
            </div>

        </form>
    </div>
@endsection

@section('footer')
    footer
@endsection
