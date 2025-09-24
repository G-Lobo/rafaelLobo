@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
<div class="relative bg-[url('/assets/img/bg/Background-main.webp')] bg-cover bg-center min-h-screen">

    <!-- overlay com gradiente preto -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/80 to-black"></div>


    <!-- Container principal da página com padding responsivo -->
    <div class="container mx-auto px-4 md:px-8 lg:px-8 py-8 relative z-10">




        <!-- Grid responsivo para o conteúdo principal -->
        <!-- Mobile = coluna. telas maiores = 2 colunas. -->
        <div class="grid grid-cols-1 md:grid-cols-2   mt-8">

            <!-- Coluna da Esquerda: Imagem do Pôster -->
            <div class="w-full">
                <img src="/assets/img/coverArts/{{ $post->coverArt }}" alt="{{ $post->title }}"
                    class="rounded-lg shadow-lg w-full h-auto mx-auto md:Justify-end" style="max-width: 400px;">
            </div>

            <!-- Coluna da Direita: Detalhes do Filme -->
            <div class="flex flex-col">
                <!-- Título -->
                <h1 class="text-4xl lg:text-5xl font-bold mb-3 text-center md:text-left text-white">{{ $post->title }}</h1>

                <!-- Data de Lançamento e Duração -->
                <div class="flex justify-center md:justify-start space-x-4 mb-4 text-white">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 2a1 1 0 000 2h1v1a1 1 0 102 0V4h2v1a1 1 0 102 0V4h1a1 1 0 100-2H6zM3 8a1 1 0 011-1h12a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm2 1v8h10V9H5z"></path>
                        </svg>
                        {{ \Carbon\Carbon::parse($post->releaseDate)->format('Y') }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 8H9V5a1 1 0 112 0v5z"></path>
                        </svg>
                        {{ $post->duration }} minutos
                    </span>
                </div>

                <!-- Tipo e Áreas de Atuação -->
                <div class="flex flex-wrap justify-center md:justify-start gap-2 mb-8">
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">{{ $type->type }}</span>
                    @foreach ($post->filmAreas as $area)
                        <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">{{ $area->area }}</span>
                    @endforeach
                </div>

                <!-- Conteúdo/Descrição -->
                <div class="prose max-w-none text-center md:text-left text-white w-128 overflow-hidden text-wrap text-clip">
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        <!-- Seção de Prêmios (se houver) -->


@if ($post->prizes->isNotEmpty())
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <div class="mt-12 bg-white/80 py-12">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-center md:text-center text-gray-900">Prêmios e Reconhecimentos</h2>

            {{-- 2. Estrutura HTML do Carrossel --}}
            <div class="swiper prizes-carousel relative px-10">
                {{-- Wrapper para os slides --}}
                <div class="swiper-wrapper">
                    {{-- Loop para criar cada slide --}}
                    @foreach ($post->prizes as $prize)
                        <div class="swiper-slide flex justify-center items-center">
                            <img src="{{ asset('assets/img/prizes/' . $prize->image) }}" alt="{{ $prize->name ?? 'Prêmio' }}"
                                class="w-auto h-32 object-contain">
                        </div>
                    @endforeach
                </div>

                {{-- Setas de Navegação --}}
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                {{-- Bolinhas de Paginação --}}
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </div>

    {{-- 3. Estilos customizados para as setas e bolinhas --}}
    <style>
        .prizes-carousel {
            padding-bottom: 50px; /* Espaço para as bolinhas */
        }
        .swiper-pagination-bullet {
            background: black !important; /* Cor da bolinha para preto */
            opacity: 0.3 !important;
            transition: opacity 0.3s;
        }
        .swiper-pagination-bullet-active {
            opacity: 1 !important;
        }
        .swiper-button-next, .swiper-button-prev {
            color: black !important; /* Cor da seta para preto */
            --swiper-navigation-size: 30px; /* Tamanho das setas */
        }
        .swiper-button-prev {
            left: 0;
        }
        .swiper-button-next {
            right: 0;
        }
    </style>

    {{-- 4. Script de inicialização do Swiper --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.prizes-carousel', {
                // Efeito de loop infinito
                loop: true,
                // Centraliza os slides ativos
                centeredSlides: true,
                // Espaço entre os slides
                spaceBetween: 16,

                // Configuração de quantos slides são visíveis
                // com base no tamanho da tela (responsividade)
                breakpoints: {
                    // Telas pequenas (mobile) - agora com 2 slides
                    320: {
                        slidesPerView: 2,
                    },
                    // Telas de tablet
                    768: {
                        slidesPerView: 3,
                    },
                    // Telas de desktop
                    1280: {
                        slidesPerView: 5,
                    }
                },

                // Ativa as bolinhas de paginação
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },

                // Ativa as setas de navegação
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>
@endif



        <!--collage component -->
        <div class="mt-12">
   <x-photo-collage :images="$post->collage_images ?? []" />
</div>


        <!-- Player de Vídeo (se houver) -->
        @if ($post->videoLink)
            <div class="mt-12">
                <div class="aspect-video">
                    <iframe src="{{ $post->videoLink }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                            allowfullscreen class="w-full h-full rounded-lg shadow-lg"></iframe>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('footer')
    <x-footer />
@endsection
