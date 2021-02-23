<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Value;

class ValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Color -> Escritorios
        Value::create(['name' => 'Blanco', 'attribute_id' => 1]);
        Value::create(['name' => 'Café', 'attribute_id' => 1]);
        Value::create(['name' => 'Negro', 'attribute_id' => 1]);
        // Material -> Escritorios
        Value::create(['name' => 'Aluminio', 'attribute_id' => 2]);
        Value::create(['name' => 'Madera', 'attribute_id' => 2]);
        Value::create(['name' => 'Melamina', 'attribute_id' => 2]);
        Value::create(['name' => 'Vidrio', 'attribute_id' => 2]);

        // Estilo -> Librería
        Value::create(['name' => 'Cuadriculado', 'attribute_id' => 3]);
        Value::create(['name' => 'Rayado', 'attribute_id' => 3]);

        // Color -> Mochilas y Maletas
        Value::create(['name' => 'Amarillo', 'attribute_id' => 4]);
        Value::create(['name' => 'Azul', 'attribute_id' => 4]);
        Value::create(['name' => 'Blanco', 'attribute_id' => 4]);
        Value::create(['name' => 'Rojo', 'attribute_id' => 4]);
        Value::create(['name' => 'Rosado', 'attribute_id' => 4]);
        Value::create(['name' => 'Negro', 'attribute_id' => 4]);
        Value::create(['name' => 'Verde', 'attribute_id' => 4]);

        // Color -> Deportes
        Value::create(['name' => 'Amarillo', 'attribute_id' => 5]);
        Value::create(['name' => 'Azul', 'attribute_id' => 5]);
        Value::create(['name' => 'Blanco', 'attribute_id' => 5]);
        Value::create(['name' => 'Rojo', 'attribute_id' => 5]);
        Value::create(['name' => 'Rosado', 'attribute_id' => 5]);
        Value::create(['name' => 'Negro', 'attribute_id' => 5]);
        Value::create(['name' => 'Verde', 'attribute_id' => 5]);

        // Peso -> Gimnasio
        Value::create(['name' => '5 lb', 'attribute_id' => 6]);
        Value::create(['name' => '10 lb', 'attribute_id' => 6]);
        Value::create(['name' => '15 lb', 'attribute_id' => 6]);
        Value::create(['name' => '20 lb', 'attribute_id' => 6]);
        Value::create(['name' => '30 lb', 'attribute_id' => 6]);
        Value::create(['name' => '35 lb', 'attribute_id' => 6]);
        Value::create(['name' => '40 lb', 'attribute_id' => 6]);
        Value::create(['name' => '50 lb', 'attribute_id' => 6]);

        // Conexión -> Audio y Sonico
        Value::create(['name' => 'Alámbrico', 'attribute_id' => 7]);
        Value::create(['name' => 'Inalámbrico', 'attribute_id' => 7]);

        // Tamaño de Pantalla -> Televisión y Video
        Value::create(['name' => "16 ''", 'attribute_id' => 8]);
        Value::create(['name' => "24 ''", 'attribute_id' => 8]);
        Value::create(['name' => "28 ''", 'attribute_id' => 8]);
        Value::create(['name' => "32 ''", 'attribute_id' => 8]);
        Value::create(['name' => "40 ''", 'attribute_id' => 8]);
        Value::create(['name' => "50 ''", 'attribute_id' => 8]);
        Value::create(['name' => "55 ''", 'attribute_id' => 8]);
        Value::create(['name' => "65 ''", 'attribute_id' => 8]);

        // RAM -> Laptops
        Value::create(['name' => "2 GB", 'attribute_id' => 9]);
        Value::create(['name' => "4 GB", 'attribute_id' => 9]);
        Value::create(['name' => "6 GB", 'attribute_id' => 9]);
        Value::create(['name' => "8 GB", 'attribute_id' => 9]);
        Value::create(['name' => "12 GB", 'attribute_id' => 9]);
        Value::create(['name' => "16 GB", 'attribute_id' => 9]);
        // Procesador -> Laptops
        Value::create(['name' => "Intel Core i3", 'attribute_id' => 10]);
        Value::create(['name' => "Intel Core i5", 'attribute_id' => 10]);
        Value::create(['name' => "Intel Core i7", 'attribute_id' => 10]);
        // Almacenamiento -> Laptops
        Value::create(['name' => "500 GB HDD", 'attribute_id' => 11]);
        Value::create(['name' => "1 TB HDD", 'attribute_id' => 11]);
        Value::create(['name' => "2TB HDD", 'attribute_id' => 11]);
        Value::create(['name' => "256 GB SSD", 'attribute_id' => 11]);
        Value::create(['name' => "512 GB SSD", 'attribute_id' => 11]);
        Value::create(['name' => "1 TB SSD", 'attribute_id' => 11]);
        // Tamaño de Pantalla -> Laptops
        Value::create(['name' => "12 ''", 'attribute_id' => 12]);
        Value::create(['name' => "14 ''", 'attribute_id' => 12]);
        Value::create(['name' => "15 ''", 'attribute_id' => 12]);
        Value::create(['name' => "17 ''", 'attribute_id' => 12]);

        // RAM -> Celulares
        Value::create(['name' => "1 GB", 'attribute_id' => 13]);
        Value::create(['name' => "2 GB", 'attribute_id' => 13]);
        Value::create(['name' => "4 GB", 'attribute_id' => 13]);
        // Procesador -> Celulares
        Value::create(['name' => "Snapdragon 855+", 'attribute_id' => 14]);
        Value::create(['name' => "HiSilicon 990 5G", 'attribute_id' => 14]);
        Value::create(['name' => "Exynos 980", 'attribute_id' => 14]);
        Value::create(['name' => "Helio G90T", 'attribute_id' => 14]);
        // Cámara Principal -> Celulares
        Value::create(['name' => "16 MP", 'attribute_id' => 15]);
        Value::create(['name' => "24 MP", 'attribute_id' => 15]);
        Value::create(['name' => "32 MP", 'attribute_id' => 15]);
        Value::create(['name' => "48 MP", 'attribute_id' => 15]);
        // Cámara Frontal -> Celulares
        Value::create(['name' => "16 MP", 'attribute_id' => 16]);
        Value::create(['name' => "24 MP", 'attribute_id' => 16]);
        Value::create(['name' => "32 MP", 'attribute_id' => 16]);
        // Almacenamiento -> Celulares
        Value::create(['name' => "8 GB", 'attribute_id' => 17]);
        Value::create(['name' => "16 GB", 'attribute_id' => 17]);
        Value::create(['name' => "32 GB", 'attribute_id' => 17]);
        Value::create(['name' => "64 GB", 'attribute_id' => 17]);
        Value::create(['name' => "128 GB", 'attribute_id' => 17]);
        // Tamaño de Pantalla -> Celulares
        Value::create(['name' => "12 ''", 'attribute_id' => 18]);
        Value::create(['name' => "14 ''", 'attribute_id' => 18]);
        Value::create(['name' => "15 ''", 'attribute_id' => 18]);
        Value::create(['name' => "17 ''", 'attribute_id' => 18]);

        // Color -> Sobre Ruedas
        Value::create(['name' => 'Amarillo', 'attribute_id' => 19]);
        Value::create(['name' => 'Azul', 'attribute_id' => 19]);
        Value::create(['name' => 'Blanco', 'attribute_id' => 19]);
        Value::create(['name' => 'Rojo', 'attribute_id' => 19]);
        Value::create(['name' => 'Rosado', 'attribute_id' => 19]);
        Value::create(['name' => 'Negro', 'attribute_id' => 19]);
        Value::create(['name' => 'Verde', 'attribute_id' => 19]);

        // Color -> Electródomesticos
        Value::create(['name' => 'Amarillo', 'attribute_id' => 20]);
        Value::create(['name' => 'Azul', 'attribute_id' => 20]);
        Value::create(['name' => 'Blanco', 'attribute_id' => 20]);
        Value::create(['name' => 'Rojo', 'attribute_id' => 20]);
        Value::create(['name' => 'Rosado', 'attribute_id' => 20]);
        Value::create(['name' => 'Negro', 'attribute_id' => 20]);
        Value::create(['name' => 'Verde', 'attribute_id' => 20]);

        // Color -> Muebles
        Value::create(['name' => 'Amarillo', 'attribute_id' => 21]);
        Value::create(['name' => 'Azul', 'attribute_id' => 21]);
        Value::create(['name' => 'Blanco', 'attribute_id' => 21]);
        Value::create(['name' => 'Rojo', 'attribute_id' => 21]);
        Value::create(['name' => 'Rosado', 'attribute_id' => 21]);
        Value::create(['name' => 'Negro', 'attribute_id' => 21]);
        Value::create(['name' => 'Verde', 'attribute_id' => 21]);
        // Material -> Muebles
        Value::create(['name' => 'Aluminio', 'attribute_id' => 22]);
        Value::create(['name' => 'Madera', 'attribute_id' => 22]);
        Value::create(['name' => 'Melamina', 'attribute_id' => 22]);
        Value::create(['name' => 'Vidrio', 'attribute_id' => 22]);

        // Color -> Ropa (Mascotas)
        Value::create(['name' => 'Amarillo', 'attribute_id' => 23]);
        Value::create(['name' => 'Azul', 'attribute_id' => 23]);
        Value::create(['name' => 'Blanco', 'attribute_id' => 23]);
        Value::create(['name' => 'Rojo', 'attribute_id' => 23]);
        Value::create(['name' => 'Rosado', 'attribute_id' => 23]);
        Value::create(['name' => 'Negro', 'attribute_id' => 23]);
        Value::create(['name' => 'Verde', 'attribute_id' => 23]);

        // Color -> Calzado
        Value::create(['name' => 'Amarillo', 'attribute_id' => 24]);
        Value::create(['name' => 'Azul', 'attribute_id' => 24]);
        Value::create(['name' => 'Blanco', 'attribute_id' => 24]);
        Value::create(['name' => 'Rojo', 'attribute_id' => 24]);
        Value::create(['name' => 'Rosado', 'attribute_id' => 24]);
        Value::create(['name' => 'Negro', 'attribute_id' => 24]);
        Value::create(['name' => 'Verde', 'attribute_id' => 24]);
        // Talla -> Calzado
        Value::create(['name' => '7', 'attribute_id' => 25]);
        Value::create(['name' => '8', 'attribute_id' => 25]);
        Value::create(['name' => '9', 'attribute_id' => 25]);
        Value::create(['name' => '10', 'attribute_id' => 25]);
        Value::create(['name' => '11', 'attribute_id' => 25]);
        Value::create(['name' => '12', 'attribute_id' => 25]);

        // Color -> Ropa
        Value::create(['name' => 'Amarillo', 'attribute_id' => 26]);
        Value::create(['name' => 'Azul', 'attribute_id' => 26]);
        Value::create(['name' => 'Blanco', 'attribute_id' => 26]);
        Value::create(['name' => 'Rojo', 'attribute_id' => 26]);
        Value::create(['name' => 'Rosado', 'attribute_id' => 26]);
        Value::create(['name' => 'Negro', 'attribute_id' => 26]);
        Value::create(['name' => 'Verde', 'attribute_id' => 26]);
        // Talla -> Ropa
        Value::create(['name' => 'S', 'attribute_id' => 27]);
        Value::create(['name' => 'M', 'attribute_id' => 27]);
        Value::create(['name' => 'L', 'attribute_id' => 27]);
        Value::create(['name' => 'XL', 'attribute_id' => 27]);
        Value::create(['name' => '3', 'attribute_id' => 27]);
        Value::create(['name' => '5', 'attribute_id' => 27]);
        Value::create(['name' => '7', 'attribute_id' => 27]);
        Value::create(['name' => '9', 'attribute_id' => 27]);
        Value::create(['name' => '34', 'attribute_id' => 27]);
        Value::create(['name' => '36', 'attribute_id' => 27]);
        Value::create(['name' => '38', 'attribute_id' => 27]);
        Value::create(['name' => '40', 'attribute_id' => 27]);
        Value::create(['name' => '42', 'attribute_id' => 27]);
    }
}
