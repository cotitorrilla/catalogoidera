<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Catálogo de Objetos Geográficos IDERA')</title>
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
                <a href="{{ route('classes.index') }}" class="flex items-center space-x-4">
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
                    <a href="{{ route('classes.index') }}" class="hover:text-gray-300 transition">Inicio</a>
                    <a href="{{ route('attributes.index') }}" class="hover:text-gray-300 transition">Atributos</a>
                    <a href="#" class="hover:text-gray-300 transition">Documentación</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    @if(isset($breadcrumbs) && count($breadcrumbs) > 0)
        <div class="bg-white border-b">
            <div class="container mx-auto px-4 py-2">
                <nav class="breadcrumb text-sm text-gray-600 flex items-center space-x-2">
                    <a href="{{ route('classes.index') }}" class="flex items-center hover:text-idera-blue">
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

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 mt-auto">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm">© {{ date('Y') }} IDERA - Todos los derechos reservados</p>
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

