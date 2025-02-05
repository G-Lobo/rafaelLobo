@extends('layouts.rafaelLobo')

@section('header')
    header
@endsection

@section('content')
    index

    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif


{{$post->title}}
<br>
<br>
{{$post->releaseDate}}
<br>
<br>
{{$type->type}}
<br>
<br>
{{$post->content}}
<br>
<br>
{{$post->duration}} minutos
<br>
<br>
@foreach($post->filmAreas as $area)
    <p>{{ $area->area }}</p>
@endforeach

<br>
<br>
<img src="/assets/img/coverArts/{{$post->coverArt}}" alt="">
<br>
<br>
<iframe src="{{$post->videoLink}}" frameborder="0"></iframe>
<br>
<br>
@foreach ($post->prizes as $prize)
    <img src="{{asset('assets/img/prizes/'. $prize->image) }}" alt="">
@endforeach



@section('footer')
    footer
@endsection
