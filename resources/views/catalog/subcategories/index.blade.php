@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Gestión de Subcategorías</h2>
            <p class="text-gray-600">Administrar subcategorías del catálogo</p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.subcategories.global-create') }}" class="bg-idera-blue text-white px-6 py-2 rounded-lg hover:bg-opacity-90 transition font-medium">
                + Nueva Subcategoría
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
            <a href="{{ route('admin.subcategories.index') }}" class="px-4 py-2 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition">Limpiar Filtros</a>
        @endif
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">
                        <input type="checkbox" class="rounded">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clase</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Objetos</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($subcategories as $subcategory)
                <tr class="{{ $subcategory->trashed() ? 'bg-red-50 opacity-75' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="rounded" value="{{ $subcategory->id }}">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="font-mono font-semibold text-idera-blue">{{ $subcategory->code }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-medium text-gray-900">{{ $subcategory->catalogClass->name }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $subcategory->name }}</div>
                        @if($subcategory->definition)
                            <div class="text-sm text-gray-500 mt-1">{{ Str::limit($subcategory->definition, 80) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $subcategory->objects()->count() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($subcategory->trashed())
                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Invisible</span>
                        @else
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Visible</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                        <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="text-idera-blue hover:text-idera-blue/80">Editar</a>
                        @if($subcategory->trashed())
                            <form method="POST" action="{{ route('admin.subcategories.restore', $subcategory->id) }}" class="inline">
                                @csrf @method('POST')
                                <button type="submit" class="text-green-600 hover:text-green-500 font-medium" onclick="return confirm('¿Restaurar?')">Restaurar</button>
                            </form>
                            <form method="POST" action="{{ route('admin.subcategories.forceDelete', $subcategory->id) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-500 font-medium" onclick="return confirm('¿Eliminar permanentemente?')">Eliminar Def.</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.subcategories.destroy', $subcategory) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-500 font-medium" onclick="return confirm('¿Hacer invisible?')">Hacer Invisible</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <p class="mt-2 text-lg">No hay subcategorías</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $subcategories->appends(request()->query())->links() }}
    </div>
</div>
@endsection
