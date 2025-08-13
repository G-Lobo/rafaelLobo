<!-- 
  Componente Footer home mobile
-->
<footer class="bg-white px-6 py-8 md:px-16 md:py-10">
    <div class="container mx-auto flex flex-col md:flex-row md:justify-between items-center space-y-8 md:space-y-0">

        <!-- Logo e Ícones Sociais -->
        <div class="flex flex-col items-center md:items-start">
            <a href="{{ route('home') }}" class="font-black text-2xl text-black">RAFAEL LOBO</a>
            
            <div class="mt-4">
                <x-social-icons />
            </div>
        </div>
        </nav>

    </div>
</footer>
