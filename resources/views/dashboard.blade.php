<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Catálogo IDERA</title>
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
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-idera-blue text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center overflow-hidden border-2 border-gray-200">
                        <span class="text-idera-blue font-bold text-xl">ID</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">NOMBRE DEL ORGANISMO</h1>
                        <p class="text-sm text-gray-300">Catálogo de Objetos Geográficos</p>
                    </div>
                </a>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">Bienvenido, <strong>{{ Auth::user()->name }}</strong></span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm transition">
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Panel de Administración</h1>

            <!-- Gestión del Catálogo -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Clases -->
                <a href="{{ route('home') }}" class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Clases</h2>
                            <p class="text-sm text-gray-600">Ver clases del catálogo</p>
                        </div>
                    </div>
                </a>

                <!-- Nueva Clase -->
                <a href="{{ route('classes.create') }}" class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition hover:border-blue-400">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Nueva Clase</h2>
                            <p class="text-sm text-gray-600">Crear una nueva clase</p>
                        </div>
                    </div>
                </a>

                <!-- Nuevo Objeto -->
                <a href="{{ route('objects.create') }}" class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition hover:border-green-400">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Nuevo Objeto</h2>
                            <p class="text-sm text-gray-600">Crear un nuevo objeto</p>
                        </div>
                    </div>
                </a>

                <!-- Nueva Subcategoría -->
                <a href="{{ route('subcategories.create') }}" class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition hover:border-yellow-400">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Nueva Subcategoría</h2>
                            <p class="text-sm text-gray-600">Crear una subcategoría</p>
                        </div>
                    </div>
                </a>

                <!-- Nuevo Atributo -->
                <a href="{{ route('attributes.create') }}" class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition hover:border-red-400">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Nuevo Atributo</h2>
                            <p class="text-sm text-gray-600">Crear un atributo</p>
                        </div>
                    </div>
                </a>

                <!-- Lista de Atributos -->
                <a href="{{ route('attributes.index') }}" class="bg-white rounded-xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Atributos</h2>
                            <p class="text-sm text-gray-600">Ver todos los atributos</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Información del usuario -->
            <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Información de la sesión</h3>
                <div class="space-y-2 text-sm text-gray-600">
                    <p><strong>Usuario:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>ID:</strong> {{ Auth::user()->id }}</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
