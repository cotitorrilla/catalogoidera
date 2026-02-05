@extends('layouts.master')

@section('title', $objeto->name . ' - ' . $objeto->code . ' - IDERA')

@php
/**
 * Configuración de migas de pan para navegación.
 * Permite al usuario saber en qué parte del catálogo se encuentra.
 */
$breadcrumbs = [
    ['label' => $objeto->subcategory->catalogClass->name, 'url' => route('subcategories.show', $objeto->subcategory->catalogClass)],
    ['label' => $objeto->subcategory->name, 'url' => route('objects.index', $objeto->subcategory)],
    ['label' => $objeto->name . ' (' . $objeto->code . ')']
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

/**
 * Obtiene los colores según la clase del objeto.
 */
$colors = $classColors[$objeto->subcategory->catalogClass->code] ?? $classColors[1];

/**
 * Iconos para tipos de geometría.
 * Representan visualmente el tipo de geometría del objeto.
 */
$geometryIcons = [
    'Punto' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8"/></svg>',
    'Línea' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 17L19 7"/></svg>',
    'Polígono' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>',
];

/**
 * Iconos según el tipo de atributo.
 * Ayudan a identificar si un atributo es de selección o texto libre.
 */
$attributeIcons = [
    'selection' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/></svg>',
    'text' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>',
];
@endphp

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Tarjeta principal con datos del objeto -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden mb-6">
        <!-- Encabezado con color de la clase -->
        <div class="{{ $colors['bg'] }} px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $objeto->name }}</h1>
                    <p class="text-white/80 text-sm mt-1">{{ $objeto->subcategory->catalogClass->name }} > {{ $objeto->subcategory->name }}</p>
                </div>
                <div class="text-right">
                    <div class="bg-white/10 rounded-lg px-4 py-2">
                        <span class="text-xs text-white/80 block">Código IDERA</span>
                        <span class="text-2xl font-mono font-bold text-white">{{ $objeto->code }}</span>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Información detallada del objeto -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sección de geometría -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Geometría</span>
                    @php
                        // Colores para cada tipo de geometría
                        $geoColors = [
                            'Punto' => 'bg-green-100 text-green-800 border-green-200',
                            'Línea' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'Polígono' => 'bg-purple-100 text-purple-800 border-purple-200',
                        ];
                        $geoClass = 'bg-gray-100 text-gray-800 border-gray-200';
                        $geoIcon = '';
                        
                        // Buscar coincidencia de geometría
                        foreach ($geoColors as $key => $color) {
                            if (strpos($objeto->geometry, $key) !== false) {
                                $geoClass = $color;
                                break;
                            }
                        }
                        foreach ($geometryIcons as $key => $icon) {
                            if (strpos($objeto->geometry, $key) !== false) {
                                $geoIcon = $icon;
                                break;
                            }
                        }
                    @endphp
                    <span class="mt-2 inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium border {{ $geoClass }}">
                        {!! $geoIcon !!}
                        {{ $objeto->geometry }}
                    </span>
                </div>

                <!-- Sección del código -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Código</span>
                    <p class="mt-2 text-lg font-mono font-semibold text-gray-800">{{ $objeto->code }}</p>
                </div>

                <!-- Sección de definición -->
                <div class="bg-gray-50 rounded-lg p-4 md:col-span-1">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Definición</span>
                    <p class="mt-2 text-sm text-gray-700">{{ $objeto->definition }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de atributos del objeto -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800">Atributos</h2>
            <p class="text-sm text-gray-600 mt-1">Lista de atributos definidos para este objeto geográfico</p>
        </div>

        @if($objeto->attributes->isEmpty())
            <div class="p-8 text-center">
                <p class="text-gray-500">Este objeto no tiene atributos definidos.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full object-table">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-24">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">Definición</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($objeto->attributes as $attr)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-mono text-xs font-semibold {{ $colors['text'] }} {{ $colors['bg-light'] }} px-2 py-1 rounded">
                                        {{ $attr->code }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-800">{{ $attr->name }}</span>
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">
                                    <p class="text-sm text-gray-600 max-w-md">
                                        {{ $attr->definition ?: 'Sin definición' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($attr->domains->count() > 0)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {!! $attributeIcons['selection'] !!}
                                            Selección
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {!! $attributeIcons['text'] !!}
                                            Texto
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($attr->domains->count() > 0)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($attr->domains->take(3) as $domain)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700 border border-gray-200"
                                                      title="{{ $domain->label }}">
                                                    {{ $domain->code }}
                                                </span>
                                            @endforeach
                                            @if($attr->domains->count() > 3)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-50 text-gray-500">
                                                +{{ $attr->domains->count() - 3 }}
                                            </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400">Texto libre</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Sección de dominios de atributos -->
    <div class="mt-6 bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800">Dominios de Atributos</h2>
            <p class="text-sm text-gray-600 mt-1">Valores permitidos para atributos de selección</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($objeto->attributes->where('domains', '!=', null)->where('domains', '!=', []) as $attr)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-2">
                                <span class="font-mono text-xs font-semibold {{ $colors['text'] }} {{ $colors['bg-light'] }} px-2 py-1 rounded">
                                    {{ $attr->code }}
                                </span>
                                <span class="font-medium text-gray-800">{{ $attr->name }}</span>
                            </div>
                            <span class="text-xs text-gray-500">{{ $attr->domains->count() }} opciones</span>
                        </div>
                        <div class="space-y-2 max-h-48 overflow-y-auto">
                            @foreach($attr->domains as $domain)
                                <div class="flex items-start space-x-2 text-sm">
                                    <span class="font-mono text-xs bg-gray-100 px-1.5 py-0.5 rounded text-gray-700 flex-shrink-0 w-16">
                                        {{ $domain->code }}
                                    </span>
                                    <span class="text-gray-600">{{ $domain->label }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            @if($objeto->attributes->every(fn($a) => $a->domains->isEmpty()))
                <p class="text-gray-500 text-center py-4">No hay atributos con dominios definidos.</p>
            @endif
        </div>
    </div>

    <!-- Links de navegación -->
    <div class="mt-8 flex justify-between">
        <a href="{{ route('objects.index', $objeto->subcategory) }}" class="flex items-center text-gray-600 hover:text-idera-blue transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver a {{ $objeto->subcategory->name }}
        </a>
    </div>
</div>
@endsection

