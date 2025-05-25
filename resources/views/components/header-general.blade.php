<div class="hidden sticky w-full md:inline xl:inline">
    <div class="flex flex-col md:flex-row items-center justify-between pt-2 px-9 w-full">
        <!-- Left Side: RAFAEL LOBO and Icon -->
        <div class="flex items-center space-x-4">
            <h1 class="font-black text-2xl text-black">
                <a href="{{ route('home') }}">RAFAEL LOBO</a>
            </h1>
            <a href="@auth {{ route('adm.pannel') }} @else{{ route('home') }} @endauth">
                <img src="{{ asset('assets/img/icon/iconeloboPreto.png') }}" alt="Icon"
                    class="relative mb-7 h-16 w-16">
            </a>
        </div>

        <!-- Right Side: Navigation Links -->
        <div class="flex space-x-8">
            <h2 class="font-black text-xl text-black">
                <a href="{{ route('about.index') }}">BIO</a>
            </h2>
            <h2 class="font-black text-xl text-black">
                <a href="{{ route('movies.index') }}">PORTIFÓLIO</a>
            </h2>
            <h2 class="font-black text-xl text-black">
                <a href="{{ route('blog.index') }}">PUBLICAÇÕES</a>
            </h2>
        </div>
    </div>
</div>
{{-- hamburguer --}}
<nav class="sticky flex justify-between items-center w-[100%] mx-auto xl:hidden z-40">
    <div>
        <a href="@auth {{ route('adm.pannel') }} @else{{ route('home') }} @endauth">
            <img class="ml-5 h-20" src="{{ asset('assets/img/icon/iconeloboPreto.png') }}" alt="Logo">
        </a>
    </div>
    <div
        class="nav-links duration-500 absolute xl:static bg-gray-300 xl:min-h-fit min-h-[45vh] left-0 top-[-50vh] xl:w-auto w-full flex items-center px-16">
        <ul class="flex flex-col xl:flex-row md:items-center gap-[4vw]">
            <li>
                <a class=" text-[#000000] hover:text-[white] duration-500 space-x-8 font-black text-xl"
                    href="{{ route('about.index') }}">BIO</a>
            </li>
            <li>
                <a class=" text-[#000000] hover:text-[white] duration-500 space-x-8 font-black text-xl"
                    href="{{ route('blog.index') }}">PUBLICAÇÕES</a>
            </li>
            <li>
                <a class=" text-[#000000] hover:text-[white] duration-500 space-x-8 font-black text-xl"
                    href="{{ route('movies.index') }}">PORTIFÓLIO</a>
            </li>
        </ul>
    </div>

    <div class="flex items-center gap-6 xl:hidden">
        <ion-icon onclick="onToggleMenu(this)" class="text-2xl cursor-pointer text-black mr-5"
            name="menu"></ion-icon>
    </div>
</nav>



<script>
    const navLinks = document.querySelector('.nav-links');

    function onToggleMenu(e) {
        e.name = e.name === 'menu' ? 'close' : 'menu';
        navLinks.classList.toggle('top-[-2vh]');
    }
</script>
