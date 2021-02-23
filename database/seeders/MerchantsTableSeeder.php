<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Merchant;

class MerchantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant::create([
            'name' => 'Nahima Store',
            'owner_id' => 3,
            'address' => 'Plaza El Tiangue modulo B-5.'
        ]);

        Merchant::create([
            'name' => 'Alex Store',
            'owner_id' => 4,
            'address' => 'Linda Vista Sur #A-53.'
        ]);
    }
}
