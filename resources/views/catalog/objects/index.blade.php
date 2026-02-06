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

/**
 * Colores asociados a cada clase del catálogo.
 * Se utiliza para mantener consistencia visual en toda la aplicación.
 * Colores según especificación IDERA:
 * - Amarillo para Industria y Servicios
 * - Rojo para Infraestructura Social
 * - Naranja para Transporte
 * - Turqueza para Hidrografía y Oceanografía
 * - Marrón para Geografía Física
 * - Verde para Biota
 * - Gris para Demarcación
 * - Violeta para Defensa y Seguridad
 * - Celeste para Clima y Meteorología
 * - Salmón para Catastro
 * - Verde agua para Unidades Geoestadísticas
 * - Violeta/Púrpura para Abstracto
 */
$classColors = [
    1  => ['bg' => 'bg-yellow-500', 'bg-light' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'border' => 'border-yellow-500', 'hex' => '#eab308'],
    2  => ['bg' => 'bg-red-500',    'bg-light' => 'bg-red-100',    'text' => 'text-red-600',    'border' => 'border-red-500',    'hex' => '#ef4444'],
    3  => ['bg' => 'bg-orange-500', 'bg-light' => 'bg-orange-100', 'text' => 'text-orange-600', 'border' => 'border-orange-500', 'hex' => '#f97316'],
    4  => ['bg' => 'bg-teal-500',  'bg-light' => 'bg-teal-100',  'text' => 'text-teal-600',  'border' => 'border-teal-500',  'hex' => '#14b8a6'],
    5  => ['bg' => 'bg-amber-700',  'bg-light' => 'bg-amber-100',  'text' => 'text-amber-700',  'border' => 'border-amber-700',  'hex' => '#b45309'],
    6  => ['bg' => 'bg-green-500',  'bg-light' => 'bg-green-100',  'text' => 'text-green-600',  'border' => 'border-green-500',  'hex' => '#22c55e'],
    7  => ['bg' => 'bg-gray-500',   'bg-light' => 'bg-gray-100',   'text' => 'text-gray-600',   'border' => 'border-gray-500',   'hex' => '#6b7280'],
    9  => ['bg' => 'bg-violet-500', 'bg-light' => 'bg-violet-100', 'text' => 'text-violet-600', 'border' => 'border-violet-500', 'hex' => '#8b5cf6'],
    10 => ['bg' => 'bg-sky-500',   'bg-light' => 'bg-sky-100',   'text' => 'text-sky-600',   'border' => 'border-sky-500',   'hex' => '#0ea5e9'],
    11 => ['bg' => 'bg-rose-500',  'bg-light' => 'bg-rose-100',  'text' => 'text-rose-600',  'border' => 'border-rose-500',  'hex' => '#f43f5e'],
    12 => ['bg' => 'bg-emerald-500', 'bg-light' => 'bg-emerald-100', 'text' => 'text-emerald-600', 'border' => 'border-emerald-500', 'hex' => '#10b981'],
    23 => ['bg' => 'bg-purple-500', 'bg-light' => 'bg-purple-100', 'text' => 'text-purple-600', 'border' => 'border-purple-500', 'hex' => '#a855f7'],
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
 * @param string $geometry La geometría del objeto (ej: "Punto", "Polígono", "Punto/Polígono")
 * @return string HTML con las pills correspondientes
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
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-12 h-12 rounded-lg {{ $colors['bg'] }} flex items-center justify-center shadow-md">
                <span class="text-white font-bold text-xl">{{ $subcategory->catalogClass->code }}.{{ $subcategory->code }}</span>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $subcategory->name }}</h1>
                <p class="text-gray-600">{{ $subcategory->objects->count() }} objetos geográficos</p>
            </div>
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

