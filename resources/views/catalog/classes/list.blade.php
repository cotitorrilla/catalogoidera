@extends('layouts.admin')

@section('content')
<div class="p-6">
    <nav class="flex mb-4 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/admin" class="hover:text-idera-blue">Inicio</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path></svg>
                    <span class="font-medium text-gray-700">Catálogo de Objetos</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestión de Clases</h2>
            <p class="text-gray-500">Configuración de categorías y estructuras geográficas.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('admin.classes.create') }}" class="inline-flex items-center justify-center bg-idera-blue text-white px-5 py-2.5 rounded-xl hover:bg-opacity-90 transition-all shadow-sm font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nueva Clase
            </a>
        </div>
    </div>

    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div class="flex items-center p-1 bg-gray-100 rounded-lg w-fit">
            <a href="{{ request()->fullUrlWithQuery(['trashed' => null]) }}" 
               class="px-4 py-1.5 rounded-md text-sm font-medium transition {{ !request('trashed') ? 'bg-white shadow-sm text-idera-blue' : 'text-gray-500 hover:text-gray-700' }}">
                Activos
            </a>
            <a href="{{ request()->fullUrlWithQuery(['trashed' => 1]) }}" 
               class="px-4 py-1.5 rounded-md text-sm font-medium transition {{ request('trashed') ? 'bg-white shadow-sm text-idera-blue' : 'text-gray-500 hover:text-gray-700' }}">
                Eliminados
            </a>
        </div>

        <form method="GET" class="relative group max-w-md w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-idera-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por código o nombre..." 
                   class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-idera-blue/20 focus:border-idera-blue transition text-sm">
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-24">Cód.</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Clase / Descripción</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Estructura</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Estado</th>
                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($classes as $class)
                <tr class="hover:bg-blue-50/30 transition-colors group">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-bold bg-gray-100 text-idera-blue font-mono border border-gray-200">
                            {{ $class->code }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <a href="{{ route('admin.classes.edit', $class) }}" class="text-sm font-bold text-gray-900 hover:text-idera-blue transition">
                                {{ $class->name }}
                            </a>
                            @if($class->content)
                                <span class="text-xs text-gray-400 truncate max-w-xs mt-0.5" title="{{ $class->content }}">
                                    {{ Str::limit($class->content, 65) }}
                                </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <span class="text-xs font-medium text-gray-500 bg-gray-50 border border-gray-200 px-2 py-1 rounded" title="Subcategorías">
                                <span class="text-idera-blue font-bold">{{ $class->subcategories->count() }}</span> Sub.
                            </span>
                            <span class="text-xs font-medium text-gray-500 bg-gray-50 border border-gray-200 px-2 py-1 rounded" title="Objetos">
                                <span class="text-green-600 font-bold">{{ $class->subcategories->flatMap->objects->count() }}</span> Obj.
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $class->trashed() ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600' }}">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $class->trashed() ? 'bg-red-500' : 'bg-emerald-500' }}"></span>
                            {{ $class->trashed() ? 'Oculto' : 'Activo' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.classes.edit', $class) }}" class="p-2 text-gray-400 hover:text-idera-blue hover:bg-blue-50 rounded-lg transition" title="Editar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            
                            @if($class->trashed())
                                <form method="POST" action="{{ route('admin.classes.restore', $class->id) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition" title="Restaurar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.classes.destroy', $class) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition" title="Ocultar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $classes->appends(request()->query())->links() }}
    </div>
</div>
@endsection