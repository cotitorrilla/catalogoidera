<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo IDERA</title>
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
    <script>
        function openClassModal(classId) {
            // Modal simple para demo - mostrar alert con ID
            alert('Abrir modal clase ID: ' + classId + '\n(Implementación completa requiere AJAX + classes/show)');
            // TODO: Abrir modal con contenido classes/show para classId
            // window.open('/admin/classes/' + classId, '_blank', 'width=1200,height=800');
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
                        <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg text-sm transition" onclick="event.preventDefault(); this.closest('form').submit();">
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

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Clases Totales</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\CatalogClass::count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Subcategorías</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Subcategory::count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Objetos</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\CatalogObject::count() }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Atributos</p>
                <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Attribute::count() }}</p>
            </div>
        </div>
    </div>
</div>



            <!-- Gestión de Clases - Tabla -->
            <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Gestión de Clases</h2>
                        <p class="text-gray-600">Lista de clases con opciones de administración</p>
                    </div>
                    <form method="GET" action="{{ route('dashboard') }}" class="flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por código o nombre..." class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-idera-blue focus:border-transparent flex-1">
                            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Buscar</button>
                        </form>
                </div>



                <!-- Table Header -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg mb-4 overflow-hidden">
                    <div class="grid lg:grid-cols-14 md:grid-cols-12 grid-cols-10 lg:gap-8 md:gap-6 gap-4 items-center text-sm p-4 font-semibold text-gray-700 border-b">
                        <div class="col-span-1 text-center">SEL</div>
                        <div class="col-span-1 font-mono text-center">CÓDIGO</div>
                        <div class="col-span-4 lg:col-span-3 md:col-span-3 text-left">CLASE</div>
                        <div class="col-span-2 lg:col-span-2 md:col-span-2 text-center">SUBCATEGORÍA</div>
                        <div class="col-span-2 lg:col-span-2 md:col-span-2 text-center">OBJETOS</div>
                        <div class="col-span-1 text-center">ATRIB</div>
                        <div class="col-span-1 text-center">ESTADO</div>
                        <div class="col-span-3 lg:col-span-3 md:col-span-3 text-right">ACCIONES</div>
                    </div>
                </div>

                <!-- Hierarchy Cascade View -->
                <div class="space-y-4">
                    @forelse($classes as $class)
                        <x-class-hierarchy-row :class="$class" />
                    @empty
                        <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">No hay clases</h3>
                            <p class="text-gray-500 mb-4">Comienza creando la primera clase del catálogo.</p>
                            <a href="{{ route('admin.classes.create') }}" class="inline-flex items-center px-4 py-2 bg-idera-blue border border-transparent rounded-lg font-medium text-white hover:bg-opacity-90 focus:outline-none">
                                + Crear Primera Clase
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $classes->appends(request()->query())->links() }}
                </div>
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
