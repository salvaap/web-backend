<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Action;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Action::create([
            'title' => 'Aplicaciones',
            'description' => 'Vista del listado de las aplicaciones',
            'action' => 'dashboard.applications',
            'icon' => 'mdi-application',
            'application_id' => 1,
            'location' => 'toolbar',
            'order' => 1,
            'is_visible' => true,
            'is_component' => false
        ]);
        Action::create([
            'title' => 'Acciones',
            'description' => 'Vista del listado de las acciones.',
            'action' => 'dashboard.actions',
            'icon' => 'mdi-routes',
            'application_id' => 1,
            'location' => 'toolbar',
            'order' => 2,
            'is_visible' => true,
            'is_component' => false
        ]);
        Action::create([
            'title' => 'Perfiles',
            'description' => 'Vista del listado de los perfiles.',
            'action' => 'dashboard.profiles',
            'icon' => 'mdi-account-group',
            'application_id' => 1,
            'location' => 'toolbar',
            'order' => 3,
            'is_visible' => true,
            'is_component' => false
        ]);
        Action::create([
            'title' => 'Usuarios',
            'description' => 'Vista del listado de los usuarios.',
            'action' => 'dashboard.users',
            'icon' => 'mdi-account-multiple',
            'application_id' => 1,
            'location' => 'toolbar',
            'order' => 4,
            'is_visible' => true,
            'is_component' => false
        ]);
        Action::create([
            'title' => 'Escritorio',
            'description' => 'Vista principal de administración.',
            'action' => 'dashboard',
            'icon' => 'mdi-home',
            'application_id' => 1,
            'location' => 'sidebar',
            'order' => 1,
            'is_visible' => true,
            'is_component' => false
        ]);
        Action::create([
            'title' => 'Productos',
            'description' => 'Vista del listado administrativo de productos.',
            'action' => 'dashboard.products',
            'icon' => 'mdi-package',
            'application_id' => 1,
            'location' => 'sidebar',
            'order' => 2,
            'is_visible' => true,
            'is_component' => false
        ]);
        /*Action::create([
            'title' => 'Comercio',
            'description' => 'Vista de los detalles del comercio.',
            'action' => 'dashboard.commerce',
            'icon' => 'mdi-store',
            'application_id' => 1,
            'location' => 'sidebar',
            'order' => 3,
            'is_visible' => true,
            'is_component' => false
        ]);*/
    }
}
