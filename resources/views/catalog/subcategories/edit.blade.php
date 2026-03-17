@extends('layouts.master')

@section('title', 'Editar Subcategoría: ' . $subcategory->name . ' - IDERA')

@php
$breadcrumbs = [
    ['label' => 'Clases', 'url' => route('home')],
    ['label' => $subcategory->catalogClass->name, 'url' => route('subcategories.show', $subcategory->catalogClass)],
    ['label' => $subcategory->name],
    ['label' => 'Editar']
];
@endphp

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h1 class="text-xl font-semibold text-gray-800">Editar Subcategoría</h1>
            <p class="text-sm text-gray-600 mt-1">{{ $subcategory->name }}</p>
        </div>

        <form action="{{ route('subcategories.update', $subcategory) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <!-- Clase -->
                <div>
                    <label for="class_id" class="block text-sm font-medium text-gray-700 mb-1">Clase *</label>
                    <select name="class_id" 
                            id="class_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('class_id') border-red-500 @enderror"
                            required>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}" {{ old('class_id', $subcategory->class_id) == $c->id ? 'selected' : '' }}>
                                {{ $c->code }} - {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código (solo lectura) -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Código</label>
                    <input type="text" 
                           value="{{ $subcategory->code }}"
                           disabled
                           class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-500">
                    <p class="mt-1 text-xs text-gray-500">El código se genera automáticamente</p>
                </div>

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $subcategory->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="content" 
                              id="content" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('content') border-red-500 @enderror">{{ old('content', $subcategory->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-between items-center">
                <button type="button" 
                        onclick="if(confirm('¿Está seguro de eliminar esta subcategoría?')) document.getElementById('delete-form').submit()"
                        class="px-4 py-2 text-sm font-medium text-red-600 bg-white border border-red-300 rounded-lg hover:bg-red-50 transition">
                    Eliminar
                </button>

                <div class="flex space-x-3">
                    <a href="{{ route('subcategories.show', $subcategory->catalogClass) }}" 
                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-idera-blue rounded-lg hover:bg-blue-800 transition">
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </form>

        <form id="delete-form" action="{{ route('subcategories.destroy', $subcategory) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

