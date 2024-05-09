Blog Posts
<br>
@foreach ($posts as $post)
    {{$post->title}}
    <a href="{{route('blog.edit', $post->id)}}">editar</a>

    <br>
@endforeach


Filmes
<br>

@foreach ($movies as $movie)
    {{$movie->title}}
    <a href="{{route('movies.edit', $movie->id)}}">editar</a>
    <br>

@endforeach
