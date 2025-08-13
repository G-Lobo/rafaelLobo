<!-- 
  Componente Footer:
  - Usa dois layouts diferentes e alterna entre eles com base no tamanho da tela.
-->
<footer class="bg-white">
    <div class="container mx-auto">

        <!-- Layout para Telas Pequenas (Mobile) -->
        <!-- A classe 'md:hidden' faz este bloco desaparecer em telas médias e maiores -->
        <div class="md:hidden px-6 py-8">
            <div class="flex flex-col items-center space-y-4">
                <!-- Logo e Ícones Sociais (Centralizados) -->
                <div class="flex flex-col items-center">
                    <a href="{{ route('home') }}" class="font-black text-2xl text-black">RAFAEL LOBO</a>
                    <div class="mt-4">
                        <x-social-icons />
                    </div>
                </div>
                </nav>
            </div>
        </div>

        <!-- Layout para Telas Médias e Grandes (Desktop) -->
        <!-- A classe 'hidden md:flex' faz este bloco ficar escondido por padrão e aparecer como flex em telas médias e maiores -->
        <div class="hidden md:flex flex-row justify-between items-center px-16 py-4">
            <!-- Lado Esquerdo: Logo e Ícones Sociais (Alinhado à Esquerda) -->
            <div class="flex flex-col items-center flex-row items center">
                <a href="{{ route('home') }}" class="font-black text-2xl text-black">RAFAEL LOBO</a>
                <div class="mt-4">
                    <x-social-icons />
                </div>
            </div>

            <!-- Lado Direito: Links de Navegação (Alinhado à Direita) -->
            <nav class="flex flex-col items-end space-y-1">
                <a href="{{ route('home') }}" class="font-black text-lg text-black hover:text-gray-600 transition-colors">HOME</a>
                <a href="{{ route('about.index') }}" class="font-black text-lg text-black hover:text-gray-600 transition-colors">BIO</a>
                <a href="{{ route('movies.index') }}" class="font-black text-lg text-black hover:text-gray-600 transition-colors">TRABALHOS</a>
                <a href="{{ route('blog.index') }}" class="font-black text-lg text-black hover:text-gray-600 transition-colors">POSTAGENS</a>
            </nav>
        </div>

    </div>
</footer>
