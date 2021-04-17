<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condition;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Condition::create([
            'name' => 'Nuevo'
        ]);

        Condition::create([
            'name' => 'Seminuevo'
        ]);

        Condition::create([
            'name' => 'Regular'
        ]);

        Condition::create([
            'name' => 'Malo'
        ]);
    }
}
