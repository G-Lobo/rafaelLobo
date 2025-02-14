@extends('layouts.rafaelLobo')

@section('header')
<x-header-general/>
@endsection

@section('content')

<div class= "bg-transparent pt-24 pb-16">
    <div class="container mx-auto px-56">
        <div class="flex flex-col md:flex-row items-center space-y-8 md:space-y-0 md:space-x-12">
            <!-- Text Content -->
            <div class="w-full md:w-2/3 text-black">
                <h2 class="font-black text-3xl mb-6">Rafael Lobo é um cineasta graduado em Audiovisual e <em class="font-bold"> Mestre em Comunicação pela Universidade de Brasília (UnB),</em> </h2>
                <p class="text-base leading-relaxed font-small">
                    onde sua dissertação investigou as intersecções entre filosofia e horror, com foco na obra de David Cronenberg e a ideia de uma “Cosmovisão de Horror”. Ele iniciou sua carreira com o premiado curta <em class="font-semibold">Confinado</em> (2010) e, em 2011, co-fundou o Espaço Laje, um coletivo artístico em Brasília. Em 2013, dirigiu <em class="font-semibold">Palhaços Tristes</em>, consolidando sua relação com o gênero de horror. Lobo continuou explorando o gênero com uma abordagem filosófica em <em class="font-semibold">Bartleby</em> (2016), uma adaptação da obra de Melville. Em paralelo, co-dirigiu o documentário <em class="font-semibold">Luis Humberto: O Olhar Possível</em> com Mariana Costa, que aborda a trajetória do fotógrafo Luis Humberto, afastando-se do horror para explorar o universo da fotografia e a construção da memória.
                </p>
                <p class="text-base leading-relaxed font-small mt-6">
                    Recentemente, finalizou o curta-metragem <em class="font-semibold">Xarpí</em> (2024), que mistura o fantástico e o horror com a pixação nas ruas de Brasília, e atualmente está na fase de pós-produção de seu primeiro longa <em class="font-semibold">Mapas</em>, co-escrito com Lucas Gehre. Este novo projeto aborda eventos históricos de Brasília, como a submersão da Vila Amaury no Lago Paranoá, utilizando o horror para criticar a identidade urbana da cidade.
                </p>
                <p class="text-base leading-relaxed font-small mt-6">
                    Como montador, Lobo trabalhou nos longas-metragens <em class="font-semibold">O Espaço Infinito</em> (2023) e <em class="font-semibold">Repartição do Tempo</em> (2016), sendo premiado por este último no 49º Festival de Brasília. Sócio da Levante Filmes, ele acumula uma série de curtas premiados e continua desenvolvendo projetos que mesclam horror, filosofia e identidade cultural.
                </p>
            </div>

            <!-- Profile Picture with CV Box -->
            <div class="w-full md:w-1/3 flex flex-col justify-center relative ">
                <!-- Profile Picture -->
                <img src="{{asset('assets/img/profPic/_MG_6823.jpg')}}" alt="Rafael Lobo" class="rounded-lg shadow-lg w-256 h-256 object-cover">

                <!-- CV Box -->
                <a href="#" class="absolute -bottom-0 right-0 bg-red-500 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-gray-200 hover:text-red-500 transition duration-300">
                    CV
                </a>

                <div class="pt-4 justify-start">
                    <x-social-icons/>
                </div>

            </div>

        </div>
    </div>
</div>



<h2 class="text-4xl font-black text-center mb-4">Trabalhos Recentes</h2>
<div class="container mx-auto px-4 pt-16 pb-32">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach ($movies as $movie)
            <div class="flex flex-col items-center bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <div class="w-full h-full">
                    <img src="{{ asset('assets/img/coverArts/' . $movie->coverArt) }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-center text-gray-800">{{ $movie->title }}</h3>
                    @foreach($movie->filmAreas as $area)
                        <p class="text-center text-gray-600">{{ $area->area }}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@section('footer')

<x-footer/>

@endsection
