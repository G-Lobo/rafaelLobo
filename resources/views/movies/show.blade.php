{{$post->title}}
<br>
<br>
{{$post->releaseDate}}
<br>
<br>
{{$post->content}}
<br>
<br>
{{$post->duration}} minutos
<br>
<br>
<img src="/assets/img/coverArts/{{$post->coverArt}}" alt="">
<br>
<br>
<iframe src="{{$post->videoLink}}" frameborder="0"></iframe>
<br>
<br>
@foreach ($post->prizes as $prize)
    <img src="/assets/img/prizes/{{ $prize->image }}" alt="">
@endforeach
