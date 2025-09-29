@extends('layouts.rafaelLobo')


@section('content')
    <style>
        .prose * {
            color: white !important
        }
    </style>

    <div class="relative bg-[url('/assets/img/bg/Background-main.webp')] bg-cover bg-center min-h-screen">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/60 to-black"></div>

        <!-- Header -->

        <header class="pb-20">
            <x-headerWhite />
        </header>

        <div class="text-white prose container mx-auto px-4 pt-16 pb-32 relative z-10">
            <h1 class="text-center">
                QUIMERA
            </h1>
            <p class="text-justify text-lg font-bold">
                Quimera é um projeto transmidiático idealizado para se desdobrar em uma série de quadrinhos, um filme e uma
                série audiovisual. Concebida como um "experimento de horror", a série de quadrinhos é fruto da colaboração
                entre Lucas Gehre e Rafael Lobo e oferece uma leitura imersiva, que também serve como um comentário sobre a
                intersecção entre quadrinhos e cinema. Ao contrário das adaptações convencionais de super-heróis e mangás, a
                dupla explora novas formas de fusão entre essas duas linguagens, convidando o público a refletir sobre suas
                possíveis interações.
            </p>
            <p class="text-justify text-lg font-bold">
                Os quadrinhos são publicados em formato episódico, tanto digital quanto impresso, e cada capítulo é uma
                homenagem a um filme de horror diferente, desde clássicos como "Videodrome" até obras menos conhecidas do
                gênero. Os leitores são instigados a acompanhar o desenvolvimento da história de maneira seriada, em um
                formato que remete aos tradicionais gibis de banca. Com a conclusão da série, haverá uma edição compilada em
                graphic novel, com cerca de 700 páginas.
            </p>
            <p class="text-justify text-lg font-bold">
                Quimera tece uma narrativa de horror distópico no enigmático condomínio Portais de Atlântida, onde a
                aparente tranquilidade esconde segredos sombrios. Com a aproximação do misterioso planeta Quimera, a
                vigilante noturna Lícia e um grupo de adolescentes são arrastados para uma espiral de sonhos perturbadores e
                descobertas inquietantes. À medida que desvendam as camadas ocultas desse lugar, Portais de Atlântida se
                transforma em um palco de mistérios reveladores, onde forças sobrenaturais e conflitos internos ameaçam
                romper o frágil equilíbrio da comunidade.
            </p>
            <div class="flex">
                <div class="mr-1">
                <a href="https://www.instagram.com/quimera_horror/" class="text-white text-5xl" target="_blank">
                    <ion-icon name="logo-instagram"> </ion-icon>
                </a>
                </div>
                <div class="ml-2">
                <a href="https://ltgpress.com.br/quimera/"class="text-white text-5xl" target="_blank">
                    <ion-icon name="book-outline"> </ion-icon>
                </a>
                </div>
            </div>
        </div>
        <div
            class="container mx-auto px-4 pt-16 pb-32 relative z-10 grid grid-cols-1 gap-x-6 gap-y-12 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($comics as $comic)
                <a href="{{ route('comic.show', $comic->id) }}" class="group flex flex-col gap-4">
                    <div class="w-full aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden shadow-2xl">
                        <img src="{{ asset('assets/img/comicCovers/' . $comic->coverImg) }}" alt=""
                            class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                    </div>
                    <div class="mt-4 text-white w-full flex flex-col justify-center">
                        <h3 class="font-bold text-lg text-center" title="{{ $comic->title }}">{{ $comic->title }}</h3>
                        <p class="line-clamp-4">{{ strip_tags($comic->content) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection
