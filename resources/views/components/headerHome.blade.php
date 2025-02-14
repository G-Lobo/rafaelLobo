<div class="absolute w-full">
    <div class="flex flex-col md:flex-row items-center justify-between pt-7 px-9 w-full">
        <!-- Left Side: RAFAEL LOBO and Icon -->
        <div class="flex items-center space-x-4">
            <h1 class="font-black text-2xl text-white">
                <a href="{{ route('home') }}">RAFAEL LOBO</a></h1>
            <img src="{{ asset('assets/img/icon/iconeloboCinza.png') }}" alt="Icon" class="h-20 w-20">
        </div>

        <!-- Right Side: Navigation Links -->
        <div class="flex space-x-8">
            <h2 class="font-black text-xl text-white">
                <a href="{{ route('about.index') }}">BIO</a>
            </h2>
            <h2 class="font-black text-xl text-white">
                <a href="{{ route('blog.index') }}">PUBLICAÇÕES</a>
            </h2>
            <h2 class="font-black text-xl text-white">
                <a href="{{ route('movies.index') }}">PORTIFÓLIO</a>
            </h2>
        </div>
    </div>
</div>
