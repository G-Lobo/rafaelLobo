@extends('layouts.rafaelLobo')

@section('content')

    <!-- Layout normal - Telas Médias e Desktop -->
    <div class="hidden md:flex min-h-screen flex-col bg-cover bg-center">
        <x-background-image />
        <!-- HEADER -->
        <header>
            <x-headerWhite/>
        </header>


        <!-- MAIN -->
        <main class="flex-grow">
        </main>

        <!-- FOOTER -->
        <footer>
            <x-footer />
        </footer>
    </div>

    <!-- Layout Mobile com menu -->

    <div class="md:hidden min-h-screen flex flex-col">
        <x-background-image />
        <!-- HEADER -->
        <header>
            <x-headerWhite/>
        </header>

        <!-- MAIN -->
        <main class="flex-grow flex items-center justify-center">
            <nav class="flex flex-col items-center space-y-6">
                <a href="{{ route('about.index') }}" class="font-black text-3xl text-white hover:text-gray-900 transition-colors duration-300">BIO</a>
                <a href="{{ route('movies.index') }}" class="font-black text-3xl text-white hover:text-gray-900 transition-colors duration-300">TRABALHOS</a>
                <a href="{{ route('blog.index') }}" class="font-black text-3xl text-white hover:text-gray-900 transition-colors duration-300">POSTAGENS</a>
            </nav>
        </main>

        <!-- FOOTER -->
        <footer>
            <x-footer />
        </footer>
    </div>

@endsection

<!-- Deixamos as seções originais vazias para não duplicar o conteúdo -->
@section('header')
@endsection

@section('footer')
@endsection
