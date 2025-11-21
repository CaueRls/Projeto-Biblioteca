{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria Online</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    
    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    {{-- AQUI O LARAVEL (VITE) CARREGA SEU CSS E JS --}}
    @vite(['resources/css/style.css', 'resources/js/header-wrapper.js', 'resources/js/header.js', 'resources/js/hero-carousel.js'])
</head>
<body>

    {{-- HEADER (Vamos incluir como um componente depois) --}}
    <div class="header-sticky-wrapper">
        @include('partials.header')
    </div>

    {{-- CONTEÚDO DINÂMICO (Aqui entra o miolo de cada página) --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>