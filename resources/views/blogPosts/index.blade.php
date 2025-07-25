@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
    <div class="container mx-auto px-4 pt-16 pb-32">


        <!-- title  -->
        <h2 class="text-4xl font-black mb-8 text-center xl:text-left">POSTAGENS</h2>

        <div class="container mb-8 p-6">
            <div class="flex flex-col space-y-8">
                @if ($blogPosts->isEmpty())

                    <div class="self-center pt-16 text-gray-500 text-bold text-xl font-bold">
                        <h1>Ainda não temos publicações...</h1>
                    </div>
                @else
                @foreach ($blogPosts as $post)
                <a href="{{ route('blog.show', $post->id) }}">
                        <div
                            class="flex flex-col xl:flex-row items-center overflow-hidden transform transition duration-300 hover:scale-105">
                            <div class="h-48 ">
                                <img src="{{ asset('assets/img/blogImages/' . $post->image) }}" alt="{{ $post->title }}"
                                class="w-full h-full object-scale-down">
                            </div>
                            <div class="flex-1 p-4 px-8">
                                <h3 class="text-center xl:text-left text-xl font-semibold text-gray-800">{{ $post->title }}</h3>
                                <p class="text-sm text-gray-500 mb-4">{{ $post->created_at->format('d M Y') }}</p>

                                <div class="my-2 text-justify hidden xl:inline">
                                    {!! Str::limit(strip_tags($post->content), 550, '...') !!}
                                </div>
                                <div class="my-2 text-justify xl:hidden">
                                    {!! Str::limit(strip_tags($post->content), 300, '...') !!}
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- horizontal line -->
                    <div>
                        <hr class="border-gray-300 mb-4">
                    </hr>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $blogPosts->links() }}
        </div>
    </div>
@endsection


@section('footer')
    <x-footer />
@endsection
