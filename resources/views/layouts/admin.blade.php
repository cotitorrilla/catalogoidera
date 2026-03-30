<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ config('app.name') }}</title>
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
<body class="bg-gray-50 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-idera-blue text-white shadow-lg flex-shrink-0">
        <div class="p-6">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 mb-8">
                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                    <span class="text-idera-blue font-bold text-lg">ID</span>
                </div>
                <span class="text-xl font-bold">IDERA Admin</span>
            </a>
        </div>
        <nav class="mt-4">
            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-4 border-l-2 border-idera-blue bg-opacity-20 {{ request()->routeIs('dashboard') ? 'bg-idera-blue bg-opacity-20' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.classes.index') }}" class="flex items-center px-6 py-4 hover:bg-opacity-20 {{ request()->routeIs('admin.classes.*') ? 'bg-idera-blue bg-opacity-20 border-l-4 border-yellow-400' : 'hover:bg-idera-blue hover:bg-opacity-20' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Clases (Categorías)
            </a>
            <a href="{{ route('admin.subcategories.index') }}" class="flex items-center px-6 py-4 hover:bg-opacity-20 {{ request()->routeIs('admin.subcategories.*') ? 'bg-idera-blue bg-opacity-20 border-l-4 border-green-400' : 'hover:bg-idera-blue hover:bg-opacity-20' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Subcategorías
            </a>
            <a href="{{ route('admin.objects.index') }}" class="flex items-center px-6 py-4 hover:bg-opacity-20 {{ request()->routeIs('admin.objects.*') ? 'bg-idera-blue bg-opacity-20 border-l-4 border-blue-400' : 'hover:bg-idera-blue hover:bg-opacity-20' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Objetos
            </a>
            <a href="{{ route('admin.attributes.index') }}" class="flex items-center px-6 py-4 hover:bg-opacity-20 {{ request()->routeIs('admin.attributes.*') ? 'bg-idera-blue bg-opacity-20 border-l-4 border-purple-400' : 'hover:bg-idera-blue hover:bg-opacity-20' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Atributos
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-auto">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif
        @if(isset($slot))
            {{ $slot }}
        @endif
        @yield('content')
    </main>
</body>
</html>
