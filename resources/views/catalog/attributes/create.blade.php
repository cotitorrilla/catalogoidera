@extends('layouts.master')

@section('title', 'Nuevo Atributo - IDERA')

@php
$breadcrumbs = [
    ['label' => 'Atributos', 'url' => route('attributes.index')],
    ['label' => 'Nuevo']
];
@endphp

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h1 class="text-xl font-semibold text-gray-800">Nuevo Atributo</h1>
            <p class="text-sm text-gray-600 mt-1">Complete los datos para crear un nuevo atributo</p>
        </div>

        <form action="{{ route('attributes.store') }}" method="POST" class="p-6">
            @csrf

            <div class="space-y-4">
                <!-- Código -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Código *</label>
                    <input type="text" 
                           name="code" 
                           id="code" 
                           value="{{ old('code') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('code') border-red-500 @enderror"
                           required>
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Definición -->
                <div>
                    <label for="definition" class="block text-sm font-medium text-gray-700 mb-1">Definición</label>
                    <textarea name="definition" 
                              id="definition" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('definition') border-red-500 @enderror">{{ old('definition') }}</textarea>
                    @error('definition')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('attributes.index') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-idera-blue rounded-lg hover:bg-blue-800 transition">
                    Crear Atributo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

