@extends('layouts.master')

@section('title', 'Editar Atributo: ' . $attribute->name . ' - IDERA')

@php
$breadcrumbs = [
    ['label' => 'Atributos', 'url' => route('attributes.index')],
    ['label' => $attribute->name],
    ['label' => 'Editar']
];
@endphp

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h1 class="text-xl font-semibold text-gray-800">Editar Atributo</h1>
            <p class="text-sm text-gray-600 mt-1">{{ $attribute->name }}</p>
        </div>

        <form action="{{ route('attributes.update', $attribute) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Código -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Código *</label>
                    <input type="text" 
                           name="code" 
                           id="code" 
                           value="{{ old('code', $attribute->code) }}"
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
                           value="{{ old('name', $attribute->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Definición -->
                <div class="md:col-span-2">
                    <label for="definition" class="block text-sm font-medium text-gray-700 mb-1">Definición</label>
                    <textarea name="definition" 
                              id="definition" 
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-idera-blue focus:border-idera-blue @error('definition') border-red-500 @enderror">{{ old('definition', $attribute->definition) }}</textarea>
                    @error('definition')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-6 flex justify-between items-center">
                <button type="button" 
                        onclick="if(confirm('¿Está seguro de eliminar este atributo?')) document.getElementById('delete-form').submit()"
                        class="px-4 py-2 text-sm font-medium text-red-600 bg-white border border-red-300 rounded-lg hover:bg-red-50 transition">
                    Eliminar
                </button>

                <div class="flex space-x-3">
                    <a href="{{ route('attributes.index') }}" 
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

        <form id="delete-form" action="{{ route('attributes.destroy', $attribute) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <!-- Dominios del Atributo -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Dominios</h2>
                <p class="text-sm text-gray-600">Valores permitidos para este atributo</p>
            </div>
        </div>

        <!-- Formulario para agregar dominio -->
        <form action="{{ route('attributes.edit', $attribute) }}" method="POST" class="p-4 border-b border-gray-200 bg-gray-50">
            @csrf
            <input type="hidden" name="add_domain" value="1">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <input type="text" 
                       name="value_code" 
                       placeholder="Código (ej: 01)"
                       class="px-3 py-2 border border-gray-300 rounded-lg text-sm"
                       required>
                <input type="text" 
                       name="label" 
                       placeholder="Etiqueta (ej: Activo)"
                       class="px-3 py-2 border border-gray-300 rounded-lg text-sm"
                       required>
                <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                    Agregar Dominio
                </button>
            </div>
        </form>

        <!-- Lista de dominios -->
        @if($attribute->domains->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Etiqueta</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($attribute->domains as $domain)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $domain->code }}</span>
                                </td>
                                <td class="px-6 py-3">
                                    {{ $domain->label }}
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap text-right">
                                    <form action="{{ route('attributes.domains.destroy', [$attribute, $domain]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('¿Eliminar este dominio?')"
                                                class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-8 text-center text-gray-500">
                No hay dominios definidos para este atributo.
            </div>
        @endif
    </div>
</div>
@endsection

