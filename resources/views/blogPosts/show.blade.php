@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general/>
@endsection

@section('content')
<div class="container mx-auto px-4 pt-16 pb-32 max-w-3xl">
    <!-- Title -->
    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $post->title }}</h1>

    <!-- Post Date (if available) -->
    <p class="text-sm text-gray-500 mb-4">{{ $post->created_at->format('d M Y') }}</p>

    <!-- Content -->
    <div class="text-gray-700 leading-relaxed">
        {!! $post->content !!}
    </div>

    <!-- Image -->
    @if($post->image)
        <div class="mt-6">
            <img src="{{ asset('assets/img/blogImages/' . $post->image) }}" alt="Imagem do post" class="w-full rounded-lg shadow-md">
        </div>
    @endif

    <!-- PDF Download Button -->
    @if($post->pdf)
        <div class="mt-6">
            <a href="{{ asset('assets/pdf/posts/' . $post->pdf) }}" target="_blank" rel="noopener noreferrer"
                class="inline-block bg-blue-600 text-white font-medium py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition">
                📄 Baixe o PDF
            </a>
        </div>
    @endif
</div>
@endsection

@section('footer')
    <x-footer/>
@endsection
