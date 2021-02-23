<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightRange;

class WeightRangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WeightRange::create([
            'range' => '0.01 - 5.0 Kg',
            'start' => 0.01,
            'end' => 5.0,
        ]);
        WeightRange::create([
            'range' => '5.01 - 10.0 Kg',
            'start' => 5.01,
            'end' => 10.0,
        ]);
        WeightRange::create([
            'range' => '10.01 - 15.0 Kg',
            'start' => 10.01,
            'end' => 15.0,
        ]);
        WeightRange::create([
            'range' => '15.01 - 20.0 Kg',
            'start' => 15.01,
            'end' => 20.0,
        ]);
        WeightRange::create([
            'range' => '20.01 - 25.0 Kg',
            'start' => 20.01,
            'end' => 25.0,
        ]);
        WeightRange::create([
            'range' => '25.01 - 30.0 Kg',
            'start' => 25.01,
            'end' => 30.0,
        ]);
        WeightRange::create([
            'range' => '+30.01 Kg',
            'start' => 30.01,
            'end' => null,
        ]);
    }
}
