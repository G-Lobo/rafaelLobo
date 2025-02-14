@extends('layouts.rafaelLobo')

@section('header')
<x-header-general/>
@endsection

@section('content')

{{$post->title}}
<br>
{!! $post->content !!}
<br>
<img src="/assets/img/blogImages/{{ $post->image }}" alt="">
<a href="{{asset('assets/pdf/posts/' . $post->pdf)  }}" target="_blank" rel="noopener noreferrer">baixe o pdf</a>
@endsection

@section('footer')
    <xfooter/>
@endsection
