@extends('layouts.master')

@section('title', 'Clases del Catálogo - IDERA')

@php
/**
 * Configuración de colores para cada clase del catálogo.
 * Cada clase tiene su propio color distintivo para identificación visual.
 */
$classColors = [
    1 => ['bg' => 'bg-amber-500', 'bg-light' => 'bg-amber-100', 'text' => 'text-amber-600', 'border' => 'border-amber-500', 'hex' => '#f97316'],
    2 => ['bg' => 'bg-emerald-500', 'bg-light' => 'bg-emerald-100', 'text' => 'text-emerald-600', 'border' => 'border-emerald-500', 'hex' => '#10b981'],
    3 => ['bg' => 'bg-red-500', 'bg-light' => 'bg-red-100', 'text' => 'text-red-600', 'border' => 'border-red-500', 'hex' => '#ef4444'],
    4 => ['bg' => 'bg-cyan-500', 'bg-light' => 'bg-cyan-100', 'text' => 'text-cyan-600', 'border' => 'border-cyan-500', 'hex' => '#06b6d4'],
    5 => ['bg' => 'bg-violet-500', 'bg-light' => 'bg-violet-100', 'text' => 'text-violet-600', 'border' => 'border-violet-500', 'hex' => '#8b5cf6'],
];

/**
 * Iconos asociados a cada clase del catálogo.
 * Representan visualmente el tipo de objetos geográficos de cada clase.
 */
$classIcons = [
    1 => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>',
    2 => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>',
    3 => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>',
    4 => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    5 => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>',
];
@endphp

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Catálogo de Objetos Geográficos</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Explore las clases de objetos geográficos definidos por IDERA. Cada clase contiene subcategorías que agrupan objetos geográficos relacionados.</p>
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
                            <p class="text-gray-600 text-sm line-clamp-3">
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

