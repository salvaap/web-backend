<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Guillermo',
            'last_name' => 'Reyes',
            'email' => 'memo@guillermoreyes.me',
            'username' => 'memo',
            'birthday' => Carbon::createFromDate(1988, 3, 22, 'America/Managua')->startOfDay(),
            'id_number' => '0012203880032R',
            'profile_id' => 1,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('secret')
        ]);

        User::create([
            'first_name' => 'Salvador',
            'last_name' => 'Flores',
            'email' => 'salvador.jose.flores@gmail.com',
            'username' => 'salvador',
            'profile_id' => 2,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('rO@pF!ri-eKl')
        ]);

        // 3 - Merchant
        User::create([
            'first_name' => 'Nahima',
            'last_name' => 'Abadd',
            'email' => 'nahima.abadd@gmail.com',
            'username' => 'nahima',
            'profile_id' => 3,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('jWb#Tl-Gs!dA')
        ]);

        User::create([
            'first_name' => 'Alejandro',
            'last_name' => 'Gutiérrez',
            'email' => 'alejandro.gutierrez@mail.com',
            'username' => 'alex',
            'profile_id' => 3,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('eW#oc4D-s5Mnj')
        ]);

        User::create([
            'first_name' => 'Memo',
            'last_name' => 'Reyes',
            'email' => 'guillermo.reyes@mail.com',
            'username' => 'elmemo',
            'profile_id' => 5,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('bwH!2pV-r6@9F')
        ]);
    }
}
