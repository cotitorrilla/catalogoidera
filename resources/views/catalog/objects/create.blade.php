@extends('layouts.master')

@section('title', 'Nuevo Objeto - IDERA')

@php
$breadcrumbs = [
    ['label' => 'Clases', 'url' => route('classes.index')],
    ['label' => 'Nuevo Objeto']
];
@endphp

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h1 class="text-xl font-semibold text-gray-800">Nuevo Objeto</h1>
            <p class="text-sm text-gray-600 mt-1">Complete los datos para crear un nuevo objeto geográfico</p>
        </div>

        <form action="{{ route('objects.store') }}" method="POST" class="p-6">
            @csrf

            <div class="space-y-4">
                <!-- Subcategoría -->
                <div>
                    <label for="subcategory_id" class="block text-sm font-medium text-gray-700 mb-1">Subcategoría *</label>
                    <select name="subcategory_id" 
                            id="subcategory_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('subcategory_id') border-red-500 @enderror"
                            required>
                        <option value="">Seleccione una subcategoría</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>
                                {{ $sub->catalogClass->name }} > {{ $sub->code }} - {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subcategory_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Código de objeto *</label>
                    <input type="text" 
                           name="code" 
                           id="code" 
                           value="{{ old('code') }}"
                           placeholder="Ej: 01"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('code') border-red-500 @enderror"
                           required>
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Código numérico (se combinará con el código de la subcategoría)</p>
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

                <!-- Geometría -->
                <div>
                    <label for="geometry" class="block text-sm font-medium text-gray-700 mb-1">Geometría</label>
                    <select name="geometry" 
                            id="geometry"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue">
                        <option value="">Seleccione...</option>
                        <option value="Punto" {{ old('geometry') == 'Punto' ? 'selected' : '' }}>Punto</option>
                        <option value="Línea" {{ old('geometry') == 'Línea' ? 'selected' : '' }}>Línea</option>
                        <option value="Polígono" {{ old('geometry') == 'Polígono' ? 'selected' : '' }}>Polígono</option>
                        <option value="Punto/Polígono" {{ old('geometry') == 'Punto/Polígono' ? 'selected' : '' }}>Punto/Polígono</option>
                    </select>
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

                <!-- Atributos -->
                @if($attributes->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Atributos</label>
                    <div class="border border-gray-300 rounded-lg p-3 max-h-48 overflow-y-auto bg-gray-50">
                        @foreach($attributes as $attr)
                            <label class="flex items-center space-x-2 py-1 cursor-pointer">
                                <input type="checkbox" 
                                       name="attributes[]" 
                                       value="{{ $attr->id }}"
                                       {{ in_array($attr->id, old('attributes', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-idera-blue focus:ring-idera-blue">
                                <span class="text-sm text-gray-700">
                                    <span class="font-mono text-xs bg-gray-200 px-1 rounded mr-1">{{ $attr->code }}</span>
                                    {{ $attr->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('classes.index') }}" 
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-idera-blue rounded-lg hover:bg-blue-800 transition">
                    Crear Objeto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

