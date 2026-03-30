@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Editar Objeto</h2>
        
        <form method="POST" action="{{ route('admin.objects.update', $object) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subcategoría *</label>
                        <select name="subcategory_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-idera-blue focus:border-transparent @error('subcategory_id') border-red-500 @enderror">
                            <option value="">Seleccionar subcategoría</option>
                            @foreach($subcategories as $subcat)
                                <option value="{{ $subcat->id }}" {{ old('subcategory_id', $object->subcategory_id) == $subcat->id ? 'selected' : '' }}>
                                    {{ $subcat->catalogClass->code }} - {{ $subcat->code }} {{ $subcat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Código *</label>
                        <input type="text" name="code" value="{{ old('code', $object->code) }}" required readonly 
                               class="w-full border border-gray-400 bg-gray-100 rounded-lg px-4 py-3">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                        <input type="text" name="name" value="{{ old('name', $object->name) }}" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-idera-blue focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Geometría *</label>
                        <input type="text" name="geometry" value="{{ old('geometry', $object->geometry) }}" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-idera-blue focus:border-transparent @error('geometry') border-red-500 @enderror">
                        @error('geometry')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Definición</label>
                        <textarea name="definition" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-idera-blue focus:border-transparent @error('definition') border-red-500 @enderror">{{ old('definition', $object->definition) }}</textarea>
                        @error('definition')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Atributos (Actuales: {{ $object->attributes->count() }})</label>
                        <div class="space-y-2">
                            @foreach($attributes as $attribute)
                                <label class="flex items-center">
                                    <input type="checkbox" name="attributes[]" value="{{ $attribute->id }}" 
                                           {{ $object->attributes->contains($attribute->id) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-idera-blue focus:ring-idera-blue h-4 w-4">
                                    <span class="ml-3 text-sm">{{ $attribute->code }} - {{ $attribute->name }}</span>
                                    @if($attribute->domains->count() > 0)
                                        <span class="ml-2 px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Selección</span>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 mt-8">
                <a href="{{ route('admin.objects.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </a>
                <button type="submit" class="bg-idera-blue text-white px-8 py-3 rounded-lg hover:bg-opacity-90 transition font-medium">
                    Actualizar Objeto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
