<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Método principal para ejecutar todas las semillas.
     *
     * @return void
     */
    public function run()
    {
        self::seedCatalog();
        $this->command->info('Tabla catálogo inicializada con datos!');
    }

    /**
     * Método privado para llenar la tabla catálogo.
     *
     * @return void
     */
    private function seedCatalog()
    {
        // Aquí agregamos los datos que queremos insertar en la tabla catalog
        DB::table('catalog')->insert([
            [
                'nombre' => 'Producto 1',
                'descripcion' => 'Descripción del producto 1',
                'precio' => 100.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Producto 2',
                'descripcion' => 'Descripción del producto 2',
                'precio' => 150.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Puedes seguir añadiendo más productos
        ]);
    }
}
