<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ApplicationsTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(ProfilesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(ValuesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(MerchantsTableSeeder::class);
        $this->call(ConditionsTableSeeder::class);
        $this->call(WeightRangesTableSeeder::class);
    }
}
