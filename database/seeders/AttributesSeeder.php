<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Attribute;
use App\Models\AttributeDomain;

class AttributesSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/atributos-2025.json');
        $json = json_decode(File::get($path), true);

        foreach ($json as $row) {
            $attr = Attribute::updateOrCreate(
                ['code' => trim($row['codigo'])],
                [
                    'name'       => $row['nombre'] ?? null,
                    'definition' => $row['definicion'] ?? null,
                    'type'       => $row['tipo'] ?? null,
                    'notes'      => $row['observaciones'] ?? null,
                ]
            );

            // dominios (si existen)
            if (isset($row['dominio']) && is_array($row['dominio'])) {
                foreach ($row['dominio'] as $dom) {
                    if (!is_array($dom)) continue;
                    AttributeDomain::updateOrCreate(
                        [
                            'attribute_id' => $attr->id,
                            'value_code'   => is_numeric($dom['codigo'] ?? null) ? (int)$dom['codigo'] : (int)0,
                        ],
                        [
                            'label'      => isset($dom['etiqueta']) ? (string)$dom['etiqueta'] : null,
                            'definition' => $dom['definicion'] ?? null,
                            'notes'      => $dom['observaciones'] ?? null,
                        ]
                    );
                }
            }
        }
    }
}
