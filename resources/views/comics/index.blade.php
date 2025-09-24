@extends('layouts.rafaelLobo')

@section('header')
<x-header-general />
@endsection

@section('content')



{{-- texto --}}
<div>

Quimera é um projeto transmidiático idealizado para se desdobrar em uma série de quadrinhos, um filme e uma série audiovisual. Concebida como um "experimento de horror", a série de quadrinhos é fruto da colaboração entre Lucas Gehre e Rafael Lobo e oferece uma leitura imersiva, que também serve como um comentário sobre a intersecção entre quadrinhos e cinema. Ao contrário das adaptações convencionais de super-heróis e mangás, a dupla explora novas formas de fusão entre essas duas linguagens, convidando o público a refletir sobre suas possíveis interações.

Os quadrinhos são publicados em formato episódico, tanto digital quanto impresso, e cada capítulo é uma homenagem a um filme de horror diferente, desde clássicos como "Videodrome" até obras menos conhecidas do gênero. Os leitores são instigados a acompanhar o desenvolvimento da história de maneira seriada, em um formato que remete aos tradicionais gibis de banca. Com a conclusão da série, haverá uma edição compilada em graphic novel, com cerca de 700 páginas.

Quimera tece uma narrativa de horror distópico no enigmático condomínio Portais de Atlântida, onde a aparente tranquilidade esconde segredos sombrios. Com a aproximação do misterioso planeta Quimera, a vigilante noturna Lícia e um grupo de adolescentes são arrastados para uma espiral de sonhos perturbadores e descobertas inquietantes. À medida que desvendam as camadas ocultas desse lugar, Portais de Atlântida se transforma em um palco de mistérios reveladores, onde forças sobrenaturais e conflitos internos ameaçam romper o frágil equilíbrio da comunidade.
Leitura online: ltgpress.com.br/quimera/

</div>

{{-- icons --}}
Instagram: https://www.instagram.com/quimera_horror/

<p>EDIÇÕES</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach ($comics as $comic)
        <a href="{{ route('comic.show', $comic->id)}}">

            <div class="flex bg-transparent overflow-hidden transform transition duration-300 hover:scale-105">


                <img src="{{ asset('assets/img/comicCovers/' . $comic->coverImg) }}" alt="">

                    {{-- <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-800">{{ $comic->title }}</h3>

                <!-- Description -->
                    <p class="text-gray-600 text-sm mt-4">
                        {!! \Illuminate\Support\Str::limit(strip_tags($comic->content), 252, '...') !!}
                    </p> --}}
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection

@section('footer')
<x-footer />
@endsection
