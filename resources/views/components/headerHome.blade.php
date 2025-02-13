<div class="sticky w-full">
    <div class="flex flex-col md:flex-row items-center justify-between pt-7 px-9 w-full">
        <!-- Left Side: RAFAEL LOBO and Icon -->
        <div class="flex items-center space-x-4">
            <h1 class="font-black text-5xl text-white">RAFAEL LOBO</h1>
            <img src="{{ asset('assets/img/icon/iconeloboCinza.png') }}" alt="Icon" class="h-20 w-20">
        </div>

        <!-- Right Side: Navigation Links -->
        <div class="flex space-x-8">
            <h2 class="font-bold text-xl text-white">
                <a href="#">Bio</a>
            </h2>
            <h2 class="font-bold text-xl text-white">
                <a href="{{ route('blog.index') }}">Publicações</a>
            </h2>
            <h2 class="font-bold text-xl text-white">
                <a href="#">Portifólio</a>
            </h2>
        </div>
    </div>
</div>
