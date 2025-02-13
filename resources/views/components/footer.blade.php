<div class="flex justify-between px-6 py-6 bg-white">

    <!-- Left Side Links -->
    <div>
        <h1 class="font-black text-2xl text-black">RAFAEL LOBO</h1>

        <div>

        <x-social-icons/>

        </div>

    </div>

    <!-- Right Side Links -->
    <div class="flex flex-col items-end">
        <h2 class="font-heebo text-xl text-black">
            <a href="{{ route('home') }}">HOME</a>
        </h2>
        <h2 class="font-heebo text-xl text-black">
            <a href="{{ route('about.index') }}">BIO</a>
        </h2>
        <h2 class="font-heebo text-xl text-black">
            <a href="{{ route('blog.index') }}">FILMES</a>
        </h2>
        <h2 class="font-heebo text-xl text-black">
            <a href="#">POSTS</a>
        </h2>
    </div>
    </div>

    <div class="bg-[#222222] py-2">
        <div class="text-center text-white">
            <p>&copy; 2023 Rafael Lobo. All rights reserved.</p>
        </div>
</div>
