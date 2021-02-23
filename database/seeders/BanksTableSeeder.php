<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Bank::create(['name' => 'BAC']);
        // 2
        Bank::create(['name' => 'Lafise']);
    }
}
