<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/img/icon/iconeloboPreto.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />


    <style>
        .font-mont {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
    <style>
        .font-heebo {
            font-family: 'Heebo', sans-serif;
        }
    </style>
    <style>
        ion-icon {
            font-size: 32px;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Rafael Lobo</title>


</head>

<body class="font-mont bg-gray-100">
    <header class="">
        @yield('header')
    </header>

    <main class="min-h-screen ">
        @yield('content')
    </main>

    <footer>
        @yield('footer')
    </footer>


    {{-- quill rich text editor --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    {{-- ion icons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
