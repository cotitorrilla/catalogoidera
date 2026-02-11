@extends('layouts.master')

@section('title', 'Clases del Catálogo - IDERA')

@php
/**
 * Configuración de colores para cada clase del catálogo.
 * Cada clase tiene su propio color distintivo para identificación visual.
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
 * Iconos asociados a cada clase del catálogo.
 * Representan visualmente el tipo de objetos geográficos de cada clase.
 */
$classIcons = [
    1  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>',
    2  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>',
    3  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>',
    4  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    5  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>',
    6  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>',
    7  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
    9  => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
    10 => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>',
    11 => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>',
    12 => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>',
    23 => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>',
];
@endphp

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Clases del Catálogo</h1>
            <p class="text-gray-600">Explore las clases de objetos geográficos definidos por la comunidad IDERA.</p>
        </div>
        <a href="{{ route('classes.create') }}" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-idera-blue rounded-lg hover:bg-blue-800 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nueva Clase
        </a>
    </div>

    @if($classes->isEmpty())
        <div class="text-center py-12">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-gray-500">No hay clases disponibles en el catálogo.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($classes as $index => $class)
                @php
                    $colors = $classColors[$class->code] ?? $classColors[1];
                    $icon = $classIcons[$class->code] ?? $classIcons[1];
                @endphp
                <a href="{{ route('subcategories.show', $class) }}"
                   class="card-obj bg-white rounded-xl shadow-md border border-gray-100 p-6 transition-all duration-300 hover:border-{{ $colors['text'] }} group">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-lg {{ $colors['bg'] }} flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                            <span class="text-white font-bold text-lg">{{ $class->code }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2 group-hover:{{ $colors['text'] }} transition-colors">
                                {{ $class->name }}
                            </h2>
                            <p class="text-gray-600 text-sm">
                                {{ $class->content }}
                            </p>
                            <div class="mt-4 flex items-center {{ $colors['text'] }} text-sm font-medium">
                                <span>{{ $class->subcategories->count() }} subcategorías</span>
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection

