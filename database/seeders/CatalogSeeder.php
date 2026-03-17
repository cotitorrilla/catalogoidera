<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\CatalogClass;
use App\Models\Subcategory;
use App\Models\CatalogObject;
use App\Models\Attribute;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/catalogo-objetos-2025.json');
        
        if (!File::exists($path)) {
            $this->command->error("Archivo no encontrado: {$path}");
            return;
        }
        
        $classes = json_decode(File::get($path), true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error("Error JSON: " . json_last_error_msg());
            return;
        }

        foreach ($classes as $classRow) {
            $class = CatalogClass::updateOrCreate(
                ['code' => (int)$classRow['codigo']],
                [
                    'name'    => $classRow['nombre'] ?? null,
                    'content' => $classRow['contenido'] ?? null,
                ]
            );

            foreach (($classRow['subcategorias'] ?? []) as $subRow) {
                $sub = Subcategory::updateOrCreate(
                    ['class_id' => $class->id, 'code' => (int)$subRow['codigo']],
                    [
                        'name'    => $subRow['nombre'] ?? null,
                        'content' => $subRow['contenido'] ?? null,
                    ]
                );

                foreach (($subRow['objetos'] ?? []) as $objRow) {
                    $obj = CatalogObject::updateOrCreate(
                        ['code' => (int)$objRow['codigo']],
                        [
                            'subcategory_id' => $sub->id,
                            'name'           => $objRow['nombre'] ?? null,
                            'geometry'       => $objRow['geometria'] ?? null,
                            'definition'     => $objRow['definicion'] ?? null,
                        ]
                    );

                    // Pivot Objeto-Atributos a partir de la lista dentro del objeto
                    $attributeData = [];
                    foreach (($objRow['atributos'] ?? []) as $attRef) {
                        $att = Attribute::where('code', trim($attRef['codigo']))->first();
                        if ($att) {
                            $attributeData[$att->id] = ['display_name' => $attRef['denominacion'] ?? null];
                        }
                    }
                    // sync reemplaza todos los atributos del objeto con los nuevos
                    if (!empty($attributeData)) {
                        $obj->attributes()->sync($attributeData);
                    }
                }
            }
        }
    }
}

