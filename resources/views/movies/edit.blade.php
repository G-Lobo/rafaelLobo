@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg my-8">

        <!-- Error messages -->
        @foreach (['title', 'releaseDate', 'content', 'coverArt', 'duration', 'link', 'typeId', 'film_areas'] as $error)
            @error($error)
                <div class="alert alert-danger text-red-500 font-medium mb-4">
                    {{ $message }}
                </div>
            @enderror
        @endforeach

        <form action="{{ route('movies.destroy', [$post->id]) }}" method="POST" class="mb-6" onsubmit="return confirm('Tem certeza que deseja deletar este item?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                Deletar
            </button>
        </form>

        <form action="/filmes/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="flex flex-col">
                <label for="title" class="text-lg font-medium mb-2">Título do filme:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Duration -->
            <div class="flex flex-col">
                <label for="duration" class="text-lg font-medium mb-2">Duração do filme em minutos:</label>
                <input type="number" name="duration" id="duration" value="{{ old('duration', $post->duration) }}"
                    class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Release Date -->
            <div class="flex flex-col">
                <label for="releaseDate" class="text-lg font-medium mb-2">Data de lançamento do filme:</label>
                <input type="date" id="releaseDate" name="releaseDate" value="{{ old('releaseDate', $post->releaseDate?->format('Y-m-d')) }}"
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
                                modules: { toolbar: [ ['bold', 'italic', 'underline', 'strike'], ['link', 'blockquote', 'align'], [{ list: 'ordered' }, { list: 'bullet' }], ], },
                                theme: 'snow'
                            });
                            editor.root.innerHTML = quillEditorArea.value;
                            editor.on('text-change', function() { quillEditorArea.value = editor.root.innerHTML; });
                            quillEditorArea.addEventListener('input', function() { editor.root.innerHTML = quillEditorArea.value; });
                        }
                    });
                </script>
            </div>

            <!-- Cover Art -->
            <div class="flex flex-col">
                <label for="coverArt" class="text-lg font-medium mb-2">Imagem do Post:</label>
                <img src="/assets/img/coverArts/{{ $post->coverArt }}" alt="Imagem do filme"
                    class="mb-4 w-48 h-48 object-cover rounded-lg shadow-md">
                <input type="file" id="coverArt" name="coverArt" class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Collage Images (Stills) -->
            <div class="flex flex-col">
                <label for="collage_images" class="text-lg font-medium mb-2">Imagens da Colagem (Stills):</label>
                <div class="mb-4 flex flex-wrap gap-4">
                    @if($post->collage_images)
                        @foreach ($post->collage_images as $image)
                            <img src="{{ asset('assets/img/collages/' . $image) }}" alt="Imagem da colagem" class="w-24 h-24 object-cover rounded-md shadow-md">
                        @endforeach
                    @endif
                </div>
                <input type="file" id="collage_images" name="collage_images[]" multiple class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Envie novas imagens para substituir a colagem existente. Se nenhum arquivo for enviado, a colagem atual será mantida.</p>
            </div>


            <!-- Prizes -->
            <div class="flex flex-col">
                <label for="prizes" class="text-lg font-medium mb-2">Prêmios do Filme:</label>
                <div class="mb-4 flex flex-wrap gap-2">
                    @foreach ($post->prizes as $prize)
                        <img src="/assets/img/prizes/{{ $prize->image }}" alt="Premio" class="w-24 h-24 object-cover rounded-md shadow-md">
                    @endforeach
                </div>
                <input type="file" id="prizes" name="prizes[]" multiple class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Link -->
            <div class="flex flex-col">
                <label for="link" class="text-lg font-medium mb-2">Link do filme:</label>
                <input type="text" id="link" name="link" placeholder="link Vimeo ou YouTube"
                    value="{{ old('link', $post->link) }}"
                    class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Type -->
            <div class="flex flex-col">
                <label for="typeId" class="text-lg font-medium mb-2">Tipo do filme:</label>
                <select id="typeId" name="typeId" class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($filmTypes as $filmType)
                        <option value="{{ $filmType->id }}" {{ old('typeId', $post->typeId) == $filmType->id ? 'selected' : '' }}>
                            {{ $filmType->type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Film Areas -->
            <div class="flex flex-col">
                <label for="film_areas" class="text-lg font-medium mb-2">Áreas de Participação:</label>
                <select name="film_areas[]" id="film_areas" class="border-2 border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" multiple>
                    @foreach ($filmAreas as $area)
                        <option value="{{ $area->id }}" @if (in_array($area->id, old('film_areas', $post->filmAreas->pluck('id')->toArray()))) selected @endif>
                            {{ $area->area }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-between mt-6">
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    Atualizar
                </button>
                <a href="{{ route('movies.indexADM') }}" class="px-6 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 transition">
                    Voltar
                </a>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <x-footer/>
@endsection
