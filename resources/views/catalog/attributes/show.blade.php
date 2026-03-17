@extends('layouts.master')

@section('title', $attributeModel->name . ' (' . $attributeModel->code . ') - IDERA')

@php
$breadcrumbs = [
    ['label' => 'Atributos', 'url' => route('attributes.index')],
    ['label' => $attributeModel->code]
];
@endphp

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Attribute Header Card -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden mb-6">
        <div class="bg-idera-blue px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $attributeModel->name }}</h1>
                    <p class="text-gray-300 text-sm mt-1">Detalle del atributo</p>
                </div>
                <div class="bg-white/10 rounded-lg px-4 py-2">
                    <span class="text-xs text-gray-300 block">Código</span>
                    <span class="text-2xl font-mono font-bold text-white">{{ $attributeModel->code }}</span>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Código -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Código</span>
                    <p class="mt-2 text-lg font-mono font-semibold text-gray-800">{{ $attributeModel->code }}</p>
                </div>

                <!-- Tipo -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Tipo</span>
                    <p class="mt-2">
                        @if($attributeModel->domains->count() > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Selección (dominio)
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                Texto libre
                            </span>
                        @endif
                    </p>
                </div>

                <!-- Definición -->
                <div class="bg-gray-50 rounded-lg p-4 md:col-span-2">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Definición</span>
                    <p class="mt-2 text-sm text-gray-700">{{ $attributeModel->definition ?: 'Sin definición disponible.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Domains Section -->
    @if($attributeModel->domains->count() > 0)
        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800">Dominio de Valores</h2>
                <p class="text-sm text-gray-600 mt-1">Valores permitidos para este atributo</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Etiqueta</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($attributeModel->domains as $domain)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-mono text-sm font-semibold text-idera-blue bg-idera-light px-2 py-1 rounded">
                                        {{ $domain->code }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-800">{{ $domain->label }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800">Dominio de Valores</h2>
            </div>
            <div class="p-8 text-center">
                <p class="text-gray-500">Este atributo no tiene un dominio definido. Acepta texto libre.</p>
            </div>
        </div>
    @endif

    <!-- Navigation -->
    <div class="mt-8 flex justify-between">
        <a href="{{ route('attributes.index') }}" class="flex items-center text-gray-600 hover:text-idera-blue transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver a Atributos
        </a>
        <a href="{{ route('home') }}" class="flex items-center text-gray-600 hover:text-idera-blue transition">
            Volver al inicio
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </a>
    </div>
</div>
@endsection

