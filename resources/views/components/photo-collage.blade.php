{{--
  Componente de Colagem de Fotos Dinâmico
  Uso: <x-photo-collage :images="$arrayOfImageNames" />

  - `$images`: Um array com os nomes dos arquivos das imagens.
  - O layout se adapta dinamicamente ao número de imagens (de 1 a 6).
  - Se não houver imagens, o componente não renderiza nada.
--}}

@props(['images' => []])

@php
    $imageCount = count($images);
@endphp

@if ($imageCount > 0)
    @switch($imageCount)
        {{-- Caso 1: Apenas uma imagem --}}
        @case(1)
            <div class="w-full aspect-video rounded-lg overflow-hidden group">
                <img src="{{ asset('assets/img/collages/' . $images[0]) }}" alt="Foto da colagem 1"
                     class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
            </div>
            @break

        {{-- Caso 2: Duas imagens lado a lado --}}
        @case(2)
            <div class="grid grid-cols-2 gap-2 aspect-video w-full">
                @foreach ($images as $index => $image)
                    <div class="relative overflow-hidden rounded-lg group">
                        <img src="{{ asset('assets/img/collages/' . $image) }}" alt="Foto da colagem {{ $index + 1 }}"
                             class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                    </div>
                @endforeach
            </div>
            @break

        {{-- Caso 3: Uma imagem grande e duas pequenas --}}
        @case(3)
            <div class="grid grid-cols-3 grid-rows-2 gap-2 aspect-video w-full">
                <div class="relative overflow-hidden rounded-lg group col-span-2 row-span-2">
                    <img src="{{ asset('assets/img/collages/' . $images[0]) }}" alt="Foto da colagem 1" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                </div>
                <div class="relative overflow-hidden rounded-lg group">
                    <img src="{{ asset('assets/img/collages/' . $images[1]) }}" alt="Foto da colagem 2" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                </div>
                <div class="relative overflow-hidden rounded-lg group">
                    <img src="{{ asset('assets/img/collages/' . $images[2]) }}" alt="Foto da colagem 3" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                </div>
            </div>
            @break

        {{-- Caso 4: Grid 2x2 --}}
        @case(4)
            <div class="grid grid-cols-2 grid-rows-2 gap-2 aspect-video w-full">
                 @foreach ($images as $index => $image)
                    <div class="relative overflow-hidden rounded-lg group">
                        <img src="{{ asset('assets/img/collages/' . $image) }}" alt="Foto da colagem {{ $index + 1 }}"
                             class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                    </div>
                @endforeach
            </div>
            @break

        {{-- Caso 5: Layout assimétrico --}}
        @case(5)
        <div class="grid grid-cols-2 grid-rows-1 gap-2 aspect-video w-full">
             <div class="grid grid-cols-1 grid-rows-2 gap-2">
                <div class="relative overflow-hidden rounded-lg group">
                    <img src="{{ asset('assets/img/collages/' . $images[0]) }}" alt="Foto da colagem 1" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                </div>
                 <div class="relative overflow-hidden rounded-lg group">
                    <img src="{{ asset('assets/img/collages/' . $images[1]) }}" alt="Foto da colagem 2" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                </div>
</div>
<div class="grid grid-cols-1 grid-rows-3 gap-2">
                <div class="relative overflow-hidden rounded-lg group">
                    <img src="{{ asset('assets/img/collages/' . $images[2]) }}" alt="Foto da colagem 3" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                </div>
                 <div class="relative overflow-hidden rounded-lg group">
                    <img src="{{ asset('assets/img/collages/' . $images[3]) }}" alt="Foto da colagem 4" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                </div>
                 <div class="relative overflow-hidden rounded-lg group">
                    <img src="{{ asset('assets/img/collages/' . $images[4]) }}" alt="Foto da colagem 5" class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-105">
                </div>
</div>
            </div>
            @break

        {{-- Caso 6 (Default): Grid original --}}
        @default
            <div class="grid grid-cols-3 grid-rows-3 gap-2 aspect-[4/3] w-full">
                @php
                    $positions = [
                        'col-span-2 row-span-2', 'col-start-3 row-start-1', 'col-start-3 row-start-2',
                        'col-start-1 row-start-3', 'col-start-2 row-start-3', 'col-start-3 row-start-3'
                    ];
                @endphp
                @foreach ($images as $index => $image)
                    <div class="relative overflow-hidden rounded-lg group {{ $positions[$index] }}">
                        <img src="{{ asset('assets/img/collages/' . $image) }}" alt="Foto da colagem {{ $index + 1 }}"
                             class="w-full h-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-110">
                    </div>
                @endforeach
            </div>
    @endswitch
@endif
