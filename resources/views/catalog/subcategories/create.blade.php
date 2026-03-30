@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Nueva Subcategoría</h2>
        
        <form method="POST" action="{{ route('admin.subcategories.store') }}">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Clase Padre *</label>
                    <select name="class_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-idera-blue focus:border-transparent @error('class_id') border-red-500 @enderror">
                        <option value="">Seleccionar clase</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->code }} - {{ $class->name }}</option>
                        @endforeach
                    </select>
                    @error('class_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Código de Subcategoría *</label>
                    <input type="text" name="code" value="{{ old('code') }}" required 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-idera-blue focus:border-transparent @error('code') border-red-500 @enderror"
                           placeholder="Ej: 01">
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">El código completo será: CLASE.CÓDIGO (ej: 01.01)</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-idera-blue focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Definición</label>
                    <textarea name="definition" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-idera-blue focus:border-transparent @error('definition') border-red-500 @enderror">{{ old('definition') }}</textarea>
                    @error('definition')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-8">
                <a href="{{ route('admin.subcategories.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-idera-blue text-white px-8 py-3 rounded-lg hover:bg-opacity-90 transition font-medium">
                    Crear Subcategoría
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
