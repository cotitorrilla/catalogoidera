<?php

use Illuminate\Support\Facades\DB;

/**
 * Helper de colores para las clases del catálogo IDERA.
 * 
 * Proporciona colores consistentes para cada clase del catálogo de objetos geográficos.
 * Los colores siguen la especificación IDERA:
 * - Amarillo para Industria y Servicios
 * - Rojo para Infraestructura Social
 * - Naranja para Transporte
 * - Turqueza para Hidrografía y Oceanografía
 * - Marrón para Geografía Física
 * - Verde para Biota
 * - Gris para Demarcación
 * - Violeta para Defensa y Seguridad
 * - Celeste para Clima y Meteorología
 * - Salmón para Catastro
 * - Verde agua para Unidades Geoestadísticas
 * - Púrpura para Abstracto
 */

if (!function_exists('getClassColors')) {
    /**
     * Obtiene los colores asociados a una clase del catálogo.
     * 
     * @param int|string $classCode Código de la clase
     * @return array Array con las clases CSS de color
     */
    function getClassColors($classCode): array
    {
        $colors = [
            1  => ['bg' => 'bg-yellow-500', 'bg-light' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'border' => 'border-yellow-500', 'hex' => '#eab308'],
            2  => ['bg' => 'bg-red-500',    'bg-light' => 'bg-red-100',    'text' => 'text-red-600',    'border' => 'border-red-500',    'hex' => '#ef4444'],
            3  => ['bg' => 'bg-orange-500', 'bg-light' => 'bg-orange-100', 'text' => 'text-orange-600', 'border' => 'border-orange-500', 'hex' => '#f97316'],
            4  => ['bg' => 'bg-teal-500',   'bg-light' => 'bg-teal-100',   'text' => 'text-teal-600',   'border' => 'border-teal-500',   'hex' => '#14b8a6'],
            5  => ['bg' => 'bg-amber-700',  'bg-light' => 'bg-amber-100',  'text' => 'text-amber-700',  'border' => 'border-amber-700',  'hex' => '#b45309'],
            6  => ['bg' => 'bg-green-500',  'bg-light' => 'bg-green-100',  'text' => 'text-green-600',  'border' => 'border-green-500',  'hex' => '#22c55e'],
            7  => ['bg' => 'bg-gray-500',   'bg-light' => 'bg-gray-100',   'text' => 'text-gray-600',   'border' => 'border-gray-500',   'hex' => '#6b7280'],
            9  => ['bg' => 'bg-violet-500', 'bg-light' => 'bg-violet-100', 'text' => 'text-violet-600', 'border' => 'border-violet-500', 'hex' => '#8b5cf6'],
            10 => ['bg' => 'bg-sky-500',    'bg-light' => 'bg-sky-100',    'text' => 'text-sky-600',    'border' => 'border-sky-500',    'hex' => '#0ea5e9'],
            11 => ['bg' => 'bg-rose-500',   'bg-light' => 'bg-rose-100',   'text' => 'text-rose-600',   'border' => 'border-rose-500',   'hex' => '#f43f5e'],
            12 => ['bg' => 'bg-emerald-500', 'bg-light' => 'bg-emerald-100', 'text' => 'text-emerald-600', 'border' => 'border-emerald-500', 'hex' => '#10b981'],
            23 => ['bg' => 'bg-purple-500', 'bg-light' => 'bg-purple-100', 'text' => 'text-purple-600', 'border' => 'border-purple-500', 'hex' => '#a855f7'],
        ];
        
        return $colors[$classCode] ?? $colors[1];
    }
}

if (!function_exists('getBaseColor')) {
    /**
     * Obtiene el color base (sin prefijo bg-/text-/border-).
     * Útil para generar clases dinámicas en Tailwind.
     * 
     * @param int|string $classCode Código de la clase
     * @return string Color base (ej: 'yellow', 'red', 'blue')
     */
    function getBaseColor($classCode): string
    {
        $colors = getClassColors($classCode);
        // Extraer el color base de 'bg-yellow-500' -> 'yellow'
        $bg = $colors['bg'];
        $parts = explode('-', $bg);
        // Manejar colores como 'amber-700' que tienen dos partes
        if (count($parts) >= 2 && is_numeric(end($parts))) {
            array_pop($parts);
        }
        return implode('-', $parts);
    }
}

if (!function_exists('getGeometryColors')) {
    /**
     * Obtiene los colores para tipos de geometría.
     * 
     * @return array Colores para cada tipo de geometría
     */
    function getGeometryColors(): array
    {
        return [
            'Punto' => 'bg-green-100 text-green-800 border-green-200',
            'Línea' => 'bg-blue-100 text-blue-800 border-blue-200',
            'Polígono' => 'bg-purple-100 text-purple-800 border-purple-200',
        ];
    }
}

if (!function_exists('getGeometryIcons')) {
    /**
     * Obtiene los iconos SVG para tipos de geometría.
     * 
     * @param string|null $type Tipo de geometría específico
     * @return array|string Icono o array de iconos
     */
    function getGeometryIcons(?string $type = null): array|string
    {
        $icons = [
            'Punto' => '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/></svg>',
            'Línea' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-width="2" d="M4 12h16"/></svg>',
            'Polígono' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="1" stroke-width="2"/></svg>',
        ];
        
        if ($type !== null) {
            return $icons[$type] ?? '';
        }
        
        return $icons;
    }
}

if (!function_exists('generateGeometryPills')) {
    /**
     * Genera múltiples pills HTML para objetos con geometrías múltiples.
     * 
     * @param string $geometry La geometría del objeto (ej: "Punto", "Polígono", "Punto/Polígono")
     * @return string HTML con las pills correspondientes
     */
    function generateGeometryPills(string $geometry): string
    {
        $geometryTypes = ['Punto', 'Línea', 'Polígono'];
        $icons = getGeometryIcons();
        $colors = getGeometryColors();
        $pills = [];
        
        foreach ($geometryTypes as $type) {
            if (strpos($geometry, $type) !== false) {
                $icon = $icons[$type] ?? '';
                $colorClass = $colors[$type] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                $pills[] = '<span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full border ' . $colorClass . '">' . $icon . $type . '</span>';
            }
        }
        
        return implode(' ', $pills);
    }
}

