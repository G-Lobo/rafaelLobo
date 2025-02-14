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
    @error('releaseDate')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('coverArt')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('duration')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('link')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('typeId')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('film_areas')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div>

        <form action="{{ route('movies.destroy', [$post->id]) }}" method="POST"
            onsubmit="return confirm('Tem certeza que deseja deletar este item?');">
            @csrf
            @method('DELETE')
            <button type="submit">Deletar</button>
        </form>

        <form action="/filmes/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Título do filme:</label>
                <input type="text" name="title" id="title"
                    value="@if (old('title') == null) {{ $post->title }} @else {{ old('title') }} @endif">
            </div>

            <div>
                <label for="duration">Duração do filme em minutos:</label>
                {{-- <input type="number" name="duration" id="duration" value="@if (old('duration') == null) {{ $post->duration }} @else {{old('duration')}} @endif">  --}}

                <input type="number" name="duration" id="duration" value="{{ old('duration', $post->duration) }}">
            </div>

            <div>
                <label for="releaseDate">Data de lançamento do filme:</label>
                <input type="date" id="releaseDate" name="releaseDate"
                    value="{{ old('releaseDate', $post->releaseDate?->format('Y-m-d')) }}">
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
                <label for="coverArt">Imagem do Post:</label>
                <img src="/assets/img/coverArts/{{ $post->coverArt }}" alt="">
                <input type="file" id="coverArt" name="coverArt">
            </div>

            <div>
                <label for="prizes">Premios do Filme:</label>
                @foreach ($post->prizes as $prize)
                    <img src="/assets/img/prizes/{{ $prize->image }}" alt="">
                @endforeach
                <input type="file" id="image" name="prizes[]" multiple>
            </div>

            <div>
                <label for="link">Link do filme:</label>
                <input type="text" id="link" name="link" placeholder="link vimeo ou youtube"
                    value="@if (old('link') == null) {{ $post->link }} @else {{ old('link') }} @endif">
            </div>

            <div>
                <label for="link">Tipo do filme:</label>
                <select id="typeId" name="typeId" placeholder="Curta" value="{{ old('typeId') }}">
                    @foreach ($filmTypes as $filmType)
                        <option value="{{ $filmType->id }}"
                            {{ old('typeId', $post->typeId) == $filmType->id ? 'selected' : '' }}>{{ $filmType->type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="film_areas">Áreas de Participação</label>
                <select name="film_areas[]" id="film_areas" class="form-control" multiple>
                    @foreach ($filmAreas as $area)
                        <option value="{{ $area->id }}" @if (in_array($area->id, old('film_areas', $post->filmAreas->pluck('id')->toArray()))) selected @endif>
                            {{ $area->area }}</option>
                    @endforeach
                </select>
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
