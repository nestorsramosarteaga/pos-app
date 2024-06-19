<?php

namespace Database\Seeders;

use App\Models\Documento;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documento::insert([
            ['tipo_documento' => 'Cédula Ciudadania', 'abreviatura' => 'CC'],
            ['tipo_documento' => 'Pasaporte', 'abreviatura' => 'PAS'],
            ['tipo_documento' => 'Número Identidad Tributaria', 'abreviatura' => 'NIT'],
            ['tipo_documento' => 'Cédula Extranjería', 'abreviatura' => 'CE'],
        ]);
    }
}
