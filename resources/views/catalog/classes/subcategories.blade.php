@extends('layouts.master')

@section('title', $class->name . ' - Subcategorías - IDERA')

@php
/**
 * Configuración de migas de pan para navegación.
 * Permite al usuario saber en qué parte del catálogo se encuentra.
 */
$breadcrumbs = [
    ['label' => $class->name]
];

// Obtener colores desde el modelo de la clase
$colors = $class->getColors();
$baseColor = $class->getBaseColor();
@endphp

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Class Header -->
    <div class="mb-8">
        <div class="flex justify-between items-start mb-4">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-xl {{ $colors['bg'] }} flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-2xl">{{ $class->code }}</span>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $class->name }}</h1>
                    <p class="text-gray-600 mt-1">{{ $class->subcategories->count() }} subcategorías disponibles</p>
                </div>
            </div>
            <a href="{{ route('subcategories.create', ['class' => $class->id]) }}" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg transition"
               style="background-color: {{ $colors['hex'] }}"
               onmouseover="this.style.backgroundColor='{{ $colors['hex'] }}'; this.style.opacity='0.9'"
               onmouseout="this.style.backgroundColor='{{ $colors['hex'] }}'; this.style.opacity='1'">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva Subcategoría
            </a>
        </div>
        <p class="text-gray-700 bg-white rounded-lg p-4 border border-gray-200 shadow-sm">
            {{ $class->content }}
        </p>
    </div>

    @if($class->subcategories->isEmpty())
        <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-gray-500">No hay subcategorías disponibles en esta clase.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($class->subcategories as $subcategory)
                <a href="{{ route('subcategories.objects.index', $subcategory) }}"
                   class="card-obj bg-white rounded-lg border border-gray-200 p-5 transition-all duration-300 hover:shadow-md group"
                   style="border-color: {{ $colors['hex'] }}"
                   onmouseover="this.style.borderColor='{{ $colors['hex'] }}'"
                   onmouseout="this.style.borderColor='#e5e7eb'">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3 flex-1">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform"
                                 style="background-color: {{ $colors['hex'] }}20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     style="color: {{ $colors['hex'] }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="px-2 py-0.5 bg-gray-100 rounded text-xs font-mono text-gray-600">
                                        {{ $class->code }}.{{ $subcategory->code }}
                                    </span>
                                    <h3 class="text-lg font-semibold text-gray-800 transition-colors"
                                        style="color: {{ $colors['hex'] }}"
                                        onmouseover="this.style.color='{{ $colors['hex'] }}'"
                                        onmouseout="this.style.color='#1f2937'">
                                        {{ $subcategory->name }}
                                    </h3>
                                </div>
                                <p class="text-gray-600 text-sm line-clamp-2">
                                    {{ $subcategory->content }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end ml-4">
                            <span class="text-2xl font-bold" style="color: {{ $colors['hex'] }}">{{ $subcategory->objects->count() }}</span>
                            <span class="text-xs text-gray-500">objetos</span>
                            <svg class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-all mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="color: {{ $colors['hex'] }}"
                                onmouseover="this.style.transform='translateX(4px)'"
                                onmouseout="this.style.transform='translateX(0)'">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    <!-- Navigation -->
    <div class="mt-8 flex justify-between">
        <a href="{{ route('home') }}" class="flex items-center text-gray-600 hover:text-idera-blue transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver al inicio
        </a>
    </div>
</div>
@endsection

