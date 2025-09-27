@props(['overlay' => false])

<div class="absolute -z-10 bg-[url('/assets/img/bg/Background-main.webp')] h-screen w-screen bg-cover bg-center"></div>
@if($overlay)
<div class="absolute -z-10 inset-0 bg-gradient-to-b from-transparent via-black/60 to-black"></div>
@endif
