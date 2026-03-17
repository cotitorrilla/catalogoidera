<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Catálogo de Objetos Geográficos IDERA')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'idera-blue': '#1e3a5f',
                        'idera-light': '#e8f0f8',
                    }
                }
            }
        }
    </script>
    <style>
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        .card-obj:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-idera-blue text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center overflow-hidden border-2 border-gray-200">
                        <!-- Logo del organismo - reemplazar src con la ruta del logo real -->
                        <img src="" alt="Logo del organismo" class="w-full h-full object-cover hidden" id="organism-logo">
                        <span class="text-idera-blue font-bold text-xl" id="logo-placeholder">ID</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">NOMBRE DEL ORGANISMO</h1>
                        <p class="text-sm text-gray-300">Placeholder subtítulo del organismo</p>
                    </div>
                </a>
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-gray-300 transition">Inicio</a>
                    <a href="{{ route('attributes.index') }}" class="hover:text-gray-300 transition">Atributos</a>
                    <a href="#" class="hover:text-gray-300 transition">Documentación</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="hover:text-gray-300 transition">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-gray-300 transition">Cerrar sesión</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-white text-idera-blue px-4 py-2 rounded-lg hover:bg-gray-100 transition font-medium">Iniciar sesión</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    @if(isset($breadcrumbs) && count($breadcrumbs) > 0)
        <div class="bg-white border-b">
            <div class="container mx-auto px-4 py-2">
                <nav class="breadcrumb text-sm text-gray-600 flex items-center space-x-2">
                    <a href="{{ route('home') }}" class="flex items-center hover:text-idera-blue">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Inicio
                    </a>
                    @foreach($breadcrumbs as $crumb)
                        <span class="text-gray-400">/</span>
                        @if(isset($crumb['url']))
                            <a href="{{ $crumb['url'] }}" class="hover:text-idera-blue">{{ $crumb['label'] }}</a>
                        @else
                            <span class="text-gray-800 font-medium">{{ $crumb['label'] }}</span>
                        @endif
                    @endforeach
                </nav>
            </div>
        </div>
    @endif

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="container mx-auto px-4 pt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mx-auto px-4 pt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 mt-auto">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm">© {{ date('Y') }} IDERA - To dos los derechos reservados</p>
                </div>
                <div class="flex space-x-4 text-sm">
                    <a href="#" class="hover:text-white transition">Términos de uso</a>
                    <a href="#" class="hover:text-white transition">Política de privacidad</a>
                    <a href="#" class="hover:text-white transition">Contacto</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

