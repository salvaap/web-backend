<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create(['name' => 'Root'])->actions()->attach([
            1 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
            2 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
            3 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
            4 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
            5 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
            6 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
        ]);

        Profile::create(['name' => 'Administrador'])->actions()->attach([
            4 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
            5 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
            6 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
        ]);
        Profile::create(['name' => 'Comerciante'])->actions()->attach([
            5 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
            6 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
            //7 => ['create' => true, 'read' => true, 'update' => true, 'delete' => true],
        ]);
        Profile::create(['name' => 'Transportista']);
        Profile::create(['name' => 'Cliente']);
    }
}
