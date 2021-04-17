<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Category::create([
            'name' => 'Artículos Escolares y Oficina'
        ]);

        // 2
        Category::create([
            'name' => 'Ejercicio y Salud'
        ]);

        // 3
        Category::create([
            'name' => 'Electrónicos'
        ]);

        // 4
        Category::create([
            'name' => 'Entretenimiento'
        ]);

        // 5
        Category::create([
            'name' => 'Eventos'
        ]);

        // 6
        Category::create([
            'name' => 'Hogar y Ferretería'
        ]);

        // 7
        Category::create([
            'name' => 'Mascotas'
        ]);

        // 8
        Category::create([
            'name' => 'Moda'
        ]);

        // 9
        Category::create([
            'name' => 'Hobbies'
        ]);

        // 10
        Category::create([
            'name' => 'Repuestos'
        ]);

        // 11
        Category::create(['parent_id' => 1, 'name' => 'Escritorios']);
        // 12
        Category::create(['parent_id' => 1, 'name' => 'Librería']);
        // 13
        Category::create(['parent_id' => 1, 'name' => 'Mochilas y Maletas']);

        // 14
        Category::create(['parent_id' => 2, 'name' => 'Deportes']);
        // 15
        Category::create(['parent_id' => 2, 'name' => 'Gimnasio']);
        // 16
        Category::create(['parent_id' => 2, 'name' => 'Lesiones']);
        // 17
        Category::create(['parent_id' => 2, 'name' => 'Relajación']);

        // 18
        Category::create(['parent_id' => 3, 'name' => 'Audio y Sonido']);
        // 19
        Category::create(['parent_id' => 3, 'name' => 'Televisión y Video']);
        // 20
        Category::create(['parent_id' => 3, 'name' => 'Laptops']);
        // 21
        Category::create(['parent_id' => 3, 'name' => 'Celulares']);

        // 22
        Category::create(['parent_id' => 4, 'name' => 'Sobre Ruedas']);
        // 23
        Category::create(['parent_id' => 4, 'name' => 'Juegos de Mesa']);
        // 24
        Category::create(['parent_id' => 4, 'name' => 'Juguetes']);
        // 25
        Category::create(['parent_id' => 4, 'name' => 'Videojuegos y Consolas']);

        // 26
        Category::create(['parent_id' => 5, 'name' => 'Decoración']);
        // 27
        Category::create(['parent_id' => 5, 'name' => 'Fiestas']);
        // 28
        Category::create(['parent_id' => 5, 'name' => 'Regalos']);

        // 29
        Category::create(['parent_id' => 6, 'name' => 'Electrodomésticos']);
        // 30
        Category::create(['parent_id' => 6, 'name' => 'Ferretetía']);
        // 31
        Category::create(['parent_id' => 6, 'name' => 'Jardín']);
        // 32
        Category::create(['parent_id' => 6, 'name' => 'Muebles']);

        // 33
        Category::create(['parent_id' => 7, 'name' => 'Animales']);
        // 34
        Category::create(['parent_id' => 7, 'name' => 'Alimentos']);
        // 35
        Category::create(['parent_id' => 7, 'name' => 'Ropa']);
        // 36
        Category::create(['parent_id' => 7, 'name' => 'Veterinaria']);

        // 37
        Category::create(['parent_id' => 8, 'name' => 'Bolos y Billeteras']);
        // 38
        Category::create(['parent_id' => 8, 'name' => 'Calzado']);
        // 39
        Category::create(['parent_id' => 8, 'name' => 'Ropa']);
        // 40
        Category::create(['parent_id' => 8, 'name' => 'Joyería y Relojes']);

        // 41
        Category::create(['parent_id' => 9, 'name' => 'Arte']);
        // 42
        Category::create(['parent_id' => 9, 'name' => 'Libros']);
        // 43
        Category::create(['parent_id' => 9, 'name' => 'Manualidades']);
        // 44
        Category::create(['parent_id' => 9, 'name' => 'Música']);

        // 45
        Category::create(['parent_id' => 10, 'name' => 'Bicicletas']);
        // 46
        Category::create(['parent_id' => 10, 'name' => 'Camiones']);
        // 47
        Category::create(['parent_id' => 10, 'name' => 'Carros']);
        // 48
        Category::create(['parent_id' => 10, 'name' => 'Motos']);
    }
}
