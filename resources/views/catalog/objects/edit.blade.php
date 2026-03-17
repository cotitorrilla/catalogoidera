@extends('layouts.master')

@section('title', 'Editar Objeto: ' . $object->name . ' - IDERA')

@php
$breadcrumbs = [
    ['label' => 'Clases', 'url' => route('home')],
    ['label' => $object->subcategory->catalogClass->name, 'url' => route('subcategories.show', $object->subcategory->catalogClass)],
    ['label' => $object->subcategory->name, 'url' => route('subcategories.objects.index', $object->subcategory)],
    ['label' => $object->name],
    ['label' => 'Editar']
];
@endphp

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h1 class="text-xl font-semibold text-gray-800">Editar Objeto</h1>
            <p class="text-sm text-gray-600 mt-1">{{ $object->name }}</p>
        </div>

        <form action="{{ route('objects.update', $object) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <!-- Subcategoría -->
                <div>
                    <label for="subcategory_id" class="block text-sm font-medium text-gray-700 mb-1">Subcategoría *</label>
                    <select name="subcategory_id" 
                            id="subcategory_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('subcategory_id') border-red-500 @enderror"
                            required>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" {{ old('subcategory_id', $object->subcategory_id) == $sub->id ? 'selected' : '' }}>
                                {{ $sub->catalogClass->name }} > {{ $sub->code }} - {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subcategory_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Código (solo lectura) -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Código</label>
                    <input type="text" 
                           value="{{ $object->code }}"
                           disabled
                           class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-500 font-mono">
                    <p class="mt-1 text-xs text-gray-500">El código se genera automáticamente</p>
                </div>

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $object->name) }}"
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
                        <option value="Punto" {{ old('geometry', $object->geometry) == 'Punto' ? 'selected' : '' }}>Punto</option>
                        <option value="Línea" {{ old('geometry', $object->geometry) == 'Línea' ? 'selected' : '' }}>Línea</option>
                        <option value="Polígono" {{ old('geometry', $object->geometry) == 'Polígono' ? 'selected' : '' }}>Polígono</option>
                        <option value="Punto/Polígono" {{ old('geometry', $object->geometry) == 'Punto/Polígono' ? 'selected' : '' }}>Punto/Polígono</option>
                    </select>
                </div>

                <!-- Definición -->
                <div>
                    <label for="definition" class="block text-sm font-medium text-gray-700 mb-1">Definición</label>
                    <textarea name="definition" 
                              id="definition" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('definition') border-red-500 @enderror">{{ old('definition', $object->definition) }}</textarea>
                    @error('definition')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Atributos -->
                @if($attributes->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Atributos</label>
                    <div class="border border-gray-300 rounded-lg p-3 max-h-48 overflow-y-auto bg-gray-50">
                        @php $selectedAttrs = old('attributes', $object->attributes->pluck('id')->toArray()); @endphp
                        @foreach($attributes as $attr)
                            <label class="flex items-center space-x-2 py-1 cursor-pointer">
                                <input type="checkbox" 
                                       name="attributes[]" 
                                       value="{{ $attr->id }}"
                                       {{ in_array($attr->id, $selectedAttrs) ? 'checked' : '' }}
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
            <div class="mt-6 flex justify-between items-center">
                <button type="button" 
                        onclick="if(confirm('¿Está seguro de eliminar este objeto?')) document.getElementById('delete-form').submit()"
                        class="px-4 py-2 text-sm font-medium text-red-600 bg-white border border-red-300 rounded-lg hover:bg-red-50 transition">
                    Eliminar
                </button>

                <div class="flex space-x-3">
                    <a href="{{ route('subcategories.objects.index', $object->subcategory) }}"
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

        <form id="delete-form" action="{{ route('objects.destroy', $object) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
@endsection

