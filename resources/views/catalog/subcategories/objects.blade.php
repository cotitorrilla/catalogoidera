@extends('layouts.master')

@section('title', $subcategory->name . ' - Objetos - IDERA')

@php
/**
 * Configuración de migas de pan para navegación.
 * Permite al usuario saber en qué parte del catálogo se encuentra.
 */
$breadcrumbs = [
    ['label' => $subcategory->catalogClass->name, 'url' => route('subcategories.show', $subcategory->catalogClass)],
    ['label' => $subcategory->name]
];

$colors = $classColors[$subcategory->catalogClass->code] ?? $classColors[1];

/**
 * Iconos para cada tipo de geometría.
 * Ayudan a identificar visualmente el tipo de geometría de cada objeto.
 */
$geometryIcons = [
    'Punto' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/></svg>',
    'Línea' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M4 12h16"/></svg>',
    'Polígono' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="1" stroke-width="2"/></svg>',
];

/**
 * Colores para cada tipo de geometría.
 * Se utiliza para mostrar múltiples pills cuando un objeto tiene varias geometrías.
 */
$geometryColors = [
    'Punto' => 'bg-green-100 text-green-800 border-green-200',
    'Línea' => 'bg-blue-100 text-blue-800 border-blue-200',
    'Polígono' => 'bg-purple-100 text-purple-800 border-purple-200',
];

/**
 * Genera múltiples pills para objetos con geometrías múltiples.
 */
function generateGeometryPills($geometry, $geometryIcons, $geometryColors) {
    $geometryTypes = ['Punto', 'Línea', 'Polígono'];
    $pills = [];
    
    foreach ($geometryTypes as $type) {
        if (strpos($geometry, $type) !== false) {
            $icon = $geometryIcons[$type] ?? '';
            $colorClass = $geometryColors[$type] ?? 'bg-gray-100 text-gray-800 border-gray-200';
            $pills[] = '<span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full border ' . $colorClass . '">' . $icon . $type . '</span>';
        }
    }
    
    return implode(' ', $pills);
}
@endphp

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Subcategory Header -->
    <div class="mb-8">
        <div class="flex justify-between items-start mb-4">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-lg {{ $colors['bg'] }} flex items-center justify-center shadow-md">
                    <span class="text-white font-bold text-xl">{{ $subcategory->catalogClass->code }}.{{ $subcategory->code }}</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $subcategory->name }}</h1>
                    <p class="text-gray-600">{{ $subcategory->objects->count() }} objetos geográficos</p>
                </div>
            </div>
            <a href="{{ route('objects.create', ['subcategory' => $subcategory->id]) }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-{{ explode('-', $colors['bg'])[1] }}-500 rounded-lg hover:bg-{{ explode('-', $colors['bg'])[1] }}-600 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nuevo Objeto
            </a>
        </div>
        <p class="text-gray-700 bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
            {{ $subcategory->content }}
        </p>
    </div>

    @if($subcategory->objects->isEmpty())
        <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-gray-500">No hay objetos disponibles en esta subcategoría.</p>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full object-table">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Objeto</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Geometría</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden lg:table-cell">Definición</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($subcategory->objects as $object)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-mono text-sm font-semibold {{ $colors['text'] }} {{ $colors['bg-light'] }} px-2 py-1 rounded">
                                        {{ $object->code }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('objects.show', $object->code) }}"
                                       class="font-semibold text-gray-800 hover:{{ $colors['text'] }} transition">
                                        {{ $object->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        echo generateGeometryPills($object->geometry, $geometryIcons, $geometryColors);
                                    @endphp
                                </td>
                                <td class="px-6 py-4 hidden lg:table-cell">
                                    <p class="text-sm text-gray-600 line-clamp-2 max-w-md">
                                        {{ $object->definition }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <a href="{{ route('objects.show', $object->code) }}"
                                       class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded {{ $colors['text'] }} {{ $colors['bg-light'] }} hover:{{ $colors['bg'] }} hover:text-white transition">
                                        Ver ficha
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Navigation -->
    <div class="mt-8 flex justify-between">
        <a href="{{ route('subcategories.show', $subcategory->catalogClass) }}" class="flex items-center text-gray-600 hover:text-idera-blue transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver a {{ $subcategory->catalogClass->name }}
        </a>
        <a href="{{ route('classes.index') }}" class="flex items-center text-gray-600 hover:text-idera-blue transition">
            Volver al inicio
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </a>
    </div>
</div>
@endsection

