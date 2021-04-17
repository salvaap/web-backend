<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Escritorios */
        // 1
        Attribute::create(['name' => 'Color', 'category_id' => 11]);
        // 2
        Attribute::create(['name' => 'Material', 'category_id' => 11]);

        /* Librería */
        // 3
        Attribute::create(['name' => 'Estilo', 'category_id' => 12]);

        /* Mochilas y Maletas */
        // 4
        Attribute::create(['name' => 'Color', 'category_id' => 13]);

        /* Deportes */
        // 5
        Attribute::create(['name' => 'Color', 'category_id' => 14]);

        /* Gimnasio */
        // 6
        Attribute::create(['name' => 'Peso', 'category_id' => 15]);

        /* Audio y Sonido */
        // 7
        Attribute::create(['name' => 'Conexión', 'category_id' => 18]);

        /* Televisión y Video */
        // 8
        Attribute::create(['name' => 'Tamaño de Pantalla', 'category_id' => 19]);

        /* Laptops */
        // 9
        Attribute::create(['name' => 'RAM', 'category_id' => 20]);
        // 10
        Attribute::create(['name' => 'Procesador', 'category_id' => 20]);
        // 11
        Attribute::create(['name' => 'Almacenamiento', 'category_id' => 20]);
        // 12
        Attribute::create(['name' => 'Tamaño de Pantalla', 'category_id' => 20]);

        /* Celulares */
        // 13
        Attribute::create(['name' => 'RAM', 'category_id' => 21]);
        // 14
        Attribute::create(['name' => 'Procesador', 'category_id' => 21]);
        // 15
        Attribute::create(['name' => 'Cámara Principal', 'category_id' => 21]);
        // 16
        Attribute::create(['name' => 'Cámara Frontal', 'category_id' => 21]);
        // 17
        Attribute::create(['name' => 'Almacenamiento', 'category_id' => 21]);
        // 18
        Attribute::create(['name' => 'Tamaño de Pantalla', 'category_id' => 21]);

        /* Sobre Ruedas */
        // 19
        Attribute::create(['name' => 'Color', 'category_id' => 22]);

        /* Electródomesticos */
        // 20
        Attribute::create(['name' => 'Color', 'category_id' => 29]);

        /* Muebles */
        // 21
        Attribute::create(['name' => 'Color', 'category_id' => 32]);
        // 22
        Attribute::create(['name' => 'Material', 'category_id' => 32]);

        /* Ropa (Mascotas) */
        // 23
        Attribute::create(['name' => 'Color', 'category_id' => 35]);

        /* Calzado */
        // 24
        Attribute::create(['name' => 'Color', 'category_id' => 38]);
        // 25
        Attribute::create(['name' => 'Talla', 'category_id' => 38]);

        /* Ropa */
        // 26
        Attribute::create(['name' => 'Color', 'category_id' => 39]);
        // 27
        Attribute::create(['name' => 'Talla', 'category_id' => 39]);
    }
}
