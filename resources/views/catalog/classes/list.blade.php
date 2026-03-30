@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Gestión de Clases</h2>
            <p class="text-gray-600">Administrar categorías del catálogo</p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-col sm:flex-row gap-3">

            <a href="{{ route('admin.classes.create') }}" class="bg-idera-blue text-white px-6 py-2 rounded-lg hover:bg-opacity-90 transition font-medium">
                + Nueva Clase
            </a>
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por código o nombre..." class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-idera-blue focus:border-transparent flex-1">
                <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Buscar</button>
            </form>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ request()->fullUrlWithQuery(['trashed' => null]) }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg {{ !request('trashed') ? 'bg-idera-blue text-white' : '' }} hover:bg-idera-blue hover:text-white transition">
            Activos
        </a>
        <a href="{{ request()->fullUrlWithQuery(['trashed' => 1]) }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg {{ request('trashed') ? 'bg-idera-blue text-white' : '' }} hover:bg-idera-blue hover:text-white transition">
            Eliminados
        </a>
        @if(request('trashed'))
            <a href="{{ route('admin.classes.index') }}" class="px-4 py-2 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition">Limpiar Filtros</a>
        @endif
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

    <!-- New Wide Hierarchy Display -->
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
@endsection
