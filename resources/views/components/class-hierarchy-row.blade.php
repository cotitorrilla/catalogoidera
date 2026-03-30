@props(['class'])

<div class="border border-gray-200 rounded-lg overflow-hidden mb-4 hover:shadow-md transition-shadow">
  <!-- Class Header Row -->
  <details class="group">
    <summary class="list-none bg-gradient-to-r from-blue-50 to-indigo-50 p-6 cursor-pointer hover:bg-blue-100 transition-colors border-b-2 border-gray-300">
<div class="grid lg:grid-cols-14 md:grid-cols-12 grid-cols-10 lg:gap-8 md:gap-6 gap-4 items-center text-sm border-l border-r border-gray-300">
        <div class="col-span-1">
          <input type="checkbox" class="rounded text-idera-blue">
        </div>
        <div class="col-span-1 font-mono font-bold text-idera-blue col-start-2 lg:col-start-2 md:col-start-2">{{ $class->code }}</div>
        <div class="col-span-4 lg:col-span-3 md:col-span-3 font-semibold col-start-3">
          <a href="{{ route('admin.classes.edit', $class) }}" 
             class="inline-flex items-center px-4 py-2 bg-idera-blue text-white text-sm font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 group shadow-sm">
            {{ $class->name }}
            <svg class="w-4 h-4 ml-2 opacity-75 group-hover:opacity-100 transition-transform group-hover:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1 0v-1a1 1 0 00-1-1H4a1 1 0 00-1 1v3a1 1 0 001 1h9a1 1 0 001-1z"/>
            </svg>
            CLASE
          </a>
          @if($class->content)
            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($class->content, 100) }}</p>
          @endif
        </div>
        <div class="col-span-2 lg:col-span-2 md:col-span-2 text-center col-start-7 lg:col-start-6 md:col-start-6">
          <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
            {{ $class->subcategories->count() }} SUBCATEGORÍAS
          </div>
        </div>
        <div class="col-span-2 lg:col-span-2 md:col-span-2 text-center col-start-9 lg:col-start-8 md:col-start-8">
          <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">
            {{ $class->subcategories->flatMap->objects->count() }} OBJETOS
          </div>
        </div>
        <div class="col-span-1 text-center col-start-10">
          {{ $class->subcategories->flatMap->objects->flatMap->attributes->count() }} ATRIBUTOS
        </div>
<div class="col-span-1 text-center col-start-11 lg:col-start-12 md:col-start-11">
          <span class="px-2 py-1 {{ $class->trashed() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} text-xs rounded-full font-medium">
            {{ $class->trashed() ? 'Invisible' : 'Visible' }} ESTADO
          </span>
        </div>
        <div class="col-span-3 lg:col-span-3 md:col-span-3 text-right col-start-12 lg:col-start-13 md:col-start-12 flex justify-end items-center space-x-2 p-2 bg-gradient-to-r from-gray-50 to-transparent border-l border-gray-200">
          {{-- Ver/Editar --}}
          <a href="{{ route('admin.classes.edit', $class) }}" 
             class="group relative p-2.5 bg-idera-blue/90 hover:bg-idera-blue text-white rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200 flex-shrink-0 w-10 h-10"
             title="Ver / Editar clase">
            <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <span class="sr-only">Ver / Editar</span>
          </a>
          
          {{-- Toggle Visibility --}}
          @if($class->trashed())
            <form method="POST" action="{{ route('admin.classes.restore', $class->id) }}" class="inline-flex flex-shrink-0" style="display: contents;">
              @csrf @method('POST')
              <button type="submit" class="group relative p-2.5 w-10 h-10 bg-emerald-100 hover:bg-emerald-200 text-emerald-700 border border-emerald-300 rounded-xl hover:shadow-md transition-all duration-200 flex-shrink-0"
                      onclick="return confirm('{{ "¿Restaurar esta clase?" }}')"
                      title="Restaurar visibilidad">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="sr-only">Restaurar</span>
              </button>
            </form>
          @else
            <form method="POST" action="{{ route('admin.classes.destroy', $class) }}" class="inline-flex flex-shrink-0" style="display: contents;">
              @csrf @method('DELETE')
              <button type="submit" class="group relative p-2.5 w-10 h-10 bg-orange-100 hover:bg-orange-200 text-orange-800 border border-orange-300 rounded-xl hover:shadow-md transition-all duration-200 flex-shrink-0"
                      onclick="return confirm('{{ "¿Hacer invisible esta clase?" }}')"
                      title="Hacer invisible">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 8.878l4.242 4.242M9.878 8.878L12 10.12m-.5-2.242a2.998 2.998 0 00-4.242 4.242M15.878 15.878l4.242-4.242M15.878 15.878L21 12.12" />
                </svg>
                <span class="sr-only">Ocultar</span>
              </button>
            </form>
          @endif
        </div>
      </div>
    </summary>
    
    <!-- Subcategories Nested Table -->
    <div class="p-6 bg-gray-50 border-t border-gray-200">
        <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">ADMINISTRACIÓN DE OBJETOS</h4>
      @forelse($class->subcategories as $subcat)
        <div class="mb-4 p-4 bg-white rounded-lg border-l-4 border-idera-blue">
          <div class="flex justify-between items-start mb-3">
            <div>
              <h4 class="font-semibold text-idera-blue">{{ $subcat->code }} - {{ $subcat->name }}</h4>
              @if($subcat->content)
                <p class="text-sm text-gray-600">{{ Str::limit($subcat->content, 80) }}</p>
              @endif
            </div>
            <div class="text-right">
              <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-medium mr-3">
                {{ $subcat->objects->count() }} objetos
              </span>
              <a href="{{ route('admin.subcategories.edit', $subcat) }}" 
                 class="inline-flex items-center px-4 py-2 bg-idera-blue text-white text-sm font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 group shadow-sm mr-2">
                {{ $subcat->name }}
                <svg class="w-4 h-4 ml-2 opacity-75 group-hover:opacity-100 transition-transform group-hover:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1 0v-1a1 1 0 00-1-1H4a1 1 0 00-1 1v3a1 1 0 001 1h9a1 1 0 001-1z"/>
                </svg>
                SUBCATEGORÍA
              </a>
              <form method="POST" action="{{ route('admin.subcategories.destroy', $subcat) }}" class="inline">
                  @csrf @method('DELETE')
                  <button type="submit" class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 border rounded-lg transition font-medium text-gray-800 ml-2" onclick="return confirm('¿Hacer invisible?')">Ocultar</button>
              </form>
            </div>
          </div>
          
          <!-- Objects under Subcategory -->
          @forelse($subcat->objects as $obj)
            <details class="ml-6 p-3 bg-indigo-50 border border-indigo-200 rounded mb-2">
              <summary class="cursor-pointer list-none pb-2">
                <span class="font-mono text-sm mr-2">{{ $obj->code }}</span>
                <span class="font-medium">{{ $obj->name }}</span>
                <span class="ml-2 px-2 py-1 bg-gray-200 text-xs rounded">{{ $obj->geometry }}</span>
                <span class="ml-2 text-sm text-gray-600">({{ $obj->attributes->count() }} attrs)</span>
              </summary>
              
              <!-- Attributes under Object -->
              <div class="ml-6 mt-3 space-y-1">
                @forelse($obj->attributes as $attr)
                  <div class="flex items-center p-2 bg-white rounded border text-sm">
                    <span class="font-medium w-32">{{ $attr->code }}</span>
                    <span class="flex-1">{{ $attr->name }}</span>
                    <span class="px-2 py-1 bg-gray-100 text-xs rounded ml-2">{{ $attr->type }}</span>
                    @if($attr->pivot->display_name)
                      <span class="text-xs text-gray-500 ml-2">[{{ $attr->pivot->display_name }}]</span>
                    @endif
                  </div>
                @empty
                  <p class="text-sm text-gray-500 italic ml-6">Sin atributos definidos</p>
                @endforelse
              </div>
            </details>
          @empty
            <p class="text-sm text-gray-500 italic ml-6 p-3">Sin objetos en esta subcategoría</p>
          @endforelse
        </div>
      @empty
        <p class="text-sm text-gray-500 italic p-4">No hay subcategorías definidas</p>
      @endforelse
    </div>
  </details>
</div>

<script>
// toggleVisibility function removed - replaced with direct form POST for better UX and no JS dependency
</script>

