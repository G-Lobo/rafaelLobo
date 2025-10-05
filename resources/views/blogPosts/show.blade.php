@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
    <h1 class="text-3xl font-bold text-center text-gray-900 mb-2">{{ $post->title }}</h1>

    <!-- Post Date (if available) -->
    <p class="text-sm text-center text-gray-500 mb-4">{{ $post->created_at->format('d M Y') }}</p>



    <div class="bg-transparent pt-24 pb-16 relative z-10">
        <div class="container mx-auto px-4 sm:px-8 md:px-16 xl:px-56">
            <div class="flex flex-col md:flex-row items-center space-y-8 md:space-y-0 md:space-x-12">
                <!-- Text Content -->
                {{-- Usando as classes 'prose' e 'prose-invert' para estilizar o conteúdo HTML para fundos escuros --}}
                <div class="w-full md:w-2/3 prose xl:prose-invert">
                    {!! $post->content !!}
                </div>
                <!-- Profile Picture with CV Box -->
                <div class="w-full md:w-1/3 flex flex-col justify-center relative">
                    <!-- Profile Picture -->
                    <img src="{{ asset('assets/img/blogImages/' . $post->image) }}" alt="Rafael Lobo"
                        class="rounded-lg shadow-lg w-256 h-256 object-cover mx-auto">
                </div>
            </div>
        </div>
    </div>
        <!-- link -->

        <!-- video -->

        <!-- PDF Download Button -->
        @if ($post->pdf)
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
    <x-footer />
@endsection
