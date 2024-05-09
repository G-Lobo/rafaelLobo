<div>

    <form action="{{ route('movies.destroy', [$post->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>

    <form action="/filmes/{{$post->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Título do filme:</label>
            <input type="text" name="title" id="title" value="{{ $post->title }}">
        </div>

        <div>
            <label for="duration">Duração do filme em minutos:</label>
            <input type="number" name="duration" id="duration" value="{{ $post->duration }}">
        </div>

        <div>
            <label for="releaseDate">Data de lançamento do filme:</label>
            <input type="date" id="releaseDate" name="releaseDate" value="{{$post->releaseDate}}">
        </div>

        <div>
            <label for="content">Conteúdo:</label>
            <textarea name="content" id="content" cols="30" rows="10">{{ $post->content }}</textarea>
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
            <input type="text" id="link" name="link" placeholder="link vimeo ou youtube" value="{{$post->link}}">
        </div>

        <div>

            <button type="submit" class="rounded-md bg-green-600">criar</button>
            <a href="{{ route('blog.index') }}">voltar</a>
        </div>

    </form>
</div>
