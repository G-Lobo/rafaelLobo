@extends('layouts.rafaelLobo')

@section('header')
    <x-header-general />
@endsection

@section('content')
    <div class="container mx-auto px-4 pt-16 pb-32">


        {{-- title  --}}
        <h2 class="text-4xl font-black mb-8 text-center xl:text-left">PUBLICAÇÕES</h2>

        {{-- @foreach ($blogPosts as $post)
            <a href="{{ route('blog.show', $post->id) }}">
                <div class="bg-transparent overflow-hidden mb-8 p-6">


                    <!-- Title and Date -->
                    <h3 class="text-2xl font-semibold text-gray-800">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</p>

                    <!-- Video (if available) -->
                    <!--@if ($post->video)
                        <div class="mt-4">
                            <iframe src="{{ $post->video }}" class="w-full h-64 rounded-lg" frameborder="0"></iframe>
                        </div>
                    @endif -->

                    <!-- Image Preview -->
                    @if ($post->image)
                        <div class="mt-4 flex justify-start">
                            <img src="{{ asset('assets/img/blogImages/' . $post->image) }}" alt="Post Image"
                                class="max-w-32 rounded-lg">
                        </div>
                    @endif

                    <!-- Description -->
                    <p class="text-gray-700 mt-4 line-clamp-3">
                        {!! Str::limit(strip_tags($post->content), 500, '...') !!}
                    </p>

                    <!-- horizontal line -->
                    <div>
                        <hr class="border-gray-300 my-4">
                        </hr>
                    </div>
                </div>
            </a>
        @endforeach --}}
        <div class="container mb-8 p-6">
            <div class="flex flex-col space-y-8">
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
                                <div class="my-2 text-justify hidden xl:inline">
                                    {!! Str::limit(strip_tags($post->content), 550, '...') !!}
                                </div>
                                <div class="my-2 text-justify xl:hidden">
                                    {!! Str::limit(strip_tags($post->content), 300, '...') !!}
                                </div>
                            </div>
                        </div>
                    </a>
                    {{-- horizontal line --}}
                    <div>
                        <hr class="border-gray-300 mb-4">
                        </hr>
                    </div>
                @endforeach
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
