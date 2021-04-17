<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c = Country::create(['name' => 'Nicaragua', 'iso_code' => 'NIC', 'phone_code' => '505']);
        $c->departments()->create(['name' => 'Boaco'])->towns()->createMany([
            ['name' => 'Boaco'],
            ['name' => 'Camoapa'],
            ['name' => 'San José de los Remates'],
            ['name' => 'San Lorenzo'],
            ['name' => 'Santa Lucía'],

        ]);
        $c->departments()->create(['name' => 'Carazo'])->towns()->createMany([
            ['name' => 'Boaco'],
            ['name' => 'Dolores'],
            ['name' => 'El Rosario'],
            ['name' => 'Jinotepe'],
            ['name' => 'La Conquista'],
            ['name' => 'La Paz de Oriente'],
            ['name' => 'San Marcos'],
            ['name' => 'Santa Teresa'],
        ]);
        $c->departments()->create(['name' => 'Chinandega'])->towns()->createMany([
            ['name' => 'Chichigalpa'],
            ['name' => 'Chinandega'],
            ['name' => 'Cinco Pinos'],
            ['name' => 'Corinto'],
            ['name' => 'El Realejo'],
            ['name' => 'El Viejo'],
            ['name' => 'Posoltega'],
            ['name' => 'Puerto Morazán'],
            ['name' => 'San Francisco del Norte'],
            ['name' => 'San Pedro del Norte'],
            ['name' => 'San Tomás del Norte'],
            ['name' => 'Somotillo'],
            ['name' => 'Villanueva'],
        ]);
        $c->departments()->create(['name' => 'Chontales'])->towns()->createMany([
            ['name' => 'Acoyapa'],
            ['name' => 'Comalapa'],
            ['name' => 'Cuapa'],
            ['name' => 'El Coral'],
            ['name' => 'Juigalpa'],
            ['name' => 'La Libertad'],
            ['name' => 'San Pedro de Lógavo'],
            ['name' => 'Santo Domingo'],
            ['name' => 'Santo Tomás'],
            ['name' => 'Villa Sandino'],
        ]);
        $c->departments()->create(['name' => 'Costa Caribe Norte'])->towns()->createMany([
            ['name' => 'Bonanza'],
            ['name' => 'Mulukukú'],
            ['name' => 'Prinzapolka'],
            ['name' => 'Puerto Cabezas'],
            ['name' => 'Rosita'],
            ['name' => 'Siluna'],
            ['name' => 'Waslala'],
            ['name' => 'Waspán'],
        ]);
        $c->departments()->create(['name' => 'Costa Caribe Sur'])->towns()->createMany([
            ['name' => 'Bluefields'],
            ['name' => 'Desembucadora de Río Grande'],
            ['name' => 'El Ayote'],
            ['name' => 'El Rama'],
            ['name' => 'El Tortuguero'],
            ['name' => 'Corn Island'],
            ['name' => 'Kukra Hill'],
            ['name' => 'La Cruz de Río Grande'],
            ['name' => 'Laguna de Perlas'],
            ['name' => 'Muelle de los Bueyes'],
            ['name' => 'Nueva Guinea'],
            ['name' => 'Paiwas'],
        ]);
        $c->departments()->create(['name' => 'Estelí'])->towns()->createMany([
            ['name' => 'Condega'],
            ['name' => 'Estelí'],
            ['name' => 'La Trinidad'],
            ['name' => 'Pueblo Nuevo'],
            ['name' => 'San Juan de Limay'],
            ['name' => 'San Nicolás'],
        ]);
        $c->departments()->create(['name' => 'Granada'])->towns()->createMany([
            ['name' => 'Diriá'],
            ['name' => 'Diriomo'],
            ['name' => 'Granada'],
            ['name' => 'Nandaime'],
        ]);
        $c->departments()->create(['name' => 'Jinotega'])->towns()->createMany([
            ['name' => 'El Cuá'],
            ['name' => 'Jinotega'],
            ['name' => 'La Concordia'],
            ['name' => 'San José de Bocay'],
            ['name' => 'San Rafael del Norte'],
            ['name' => 'San Sebastián de Yalí'],
            ['name' => 'Santa María de Pantasma'],
            ['name' => 'Wiwilí de Jinotega'],
        ]);
        $c->departments()->create(['name' => 'León'])->towns()->createMany([
            ['name' => 'Achuapa'],
            ['name' => 'El Jicaral'],
            ['name' => 'El Sauce'],
            ['name' => 'La Paz Centro'],
            ['name' => 'Larreynaga'],
            ['name' => 'León'],
            ['name' => 'Nagarote'],
            ['name' => 'Quezalguaque'],
            ['name' => 'Santa Rosa del Peñon'],
            ['name' => 'Telica'],
        ]);
        $c->departments()->create(['name' => 'Madriz'])->towns()->createMany([
            ['name' => 'Las Sabanas'],
            ['name' => 'Palacagüina'],
            ['name' => 'San José de Cusmapa'],
            ['name' => 'San Juan de Río Coco'],
            ['name' => 'San Lucas'],
            ['name' => 'Somoto'],
            ['name' => 'Telpaneca'],
            ['name' => 'Totogalpa'],
            ['name' => 'Yalagüina'],
        ]);
        $c->departments()->create(['name' => 'Managua'])->towns()->createMany([
            ['name' => 'Ciudad Sandino'],
            ['name' => 'El Crucero'],
            ['name' => 'Managua'],
            ['name' => 'Mateare'],
            ['name' => 'San Francisco Libre'],
            ['name' => 'San Rafeal del Sur'],
            ['name' => 'Ticuantepe'],
            ['name' => 'Tipitapa'],
            ['name' => 'Villa El Carmen'],
        ]);
        $c->departments()->create(['name' => 'Masaya'])->towns()->createMany([
            ['name' => 'Catarina'],
            ['name' => 'La Concepción'],
            ['name' => 'Masatepe'],
            ['name' => 'Masaya'],
            ['name' => 'Nandasmo'],
            ['name' => 'Nindirí'],
            ['name' => 'Niquinohomo'],
            ['name' => 'San Juan de Oriente'],
            ['name' => 'Tisma'],
        ]);
        $c->departments()->create(['name' => 'Matagalpa'])->towns()->createMany([
            ['name' => 'Ciudad Darío'],
            ['name' => 'El Tuma - La Dalia'],
            ['name' => 'Esquipulas'],
            ['name' => 'Matagalpa'],
            ['name' => 'Matiguás'],
            ['name' => 'Muy Muy'],
            ['name' => 'Rancho Grande'],
            ['name' => 'Río Blanco'],
            ['name' => 'San Dionisio'],
            ['name' => 'San Isidro'],
            ['name' => 'San Ramón'],
            ['name' => 'Sébaco'],
            ['name' => 'Terrabona'],
        ]);
        $c->departments()->create(['name' => 'Nueva Segovia'])->towns()->createMany([
            ['name' => 'Ciudad Antigua'],
            ['name' => 'Dipilto'],
            ['name' => 'El Jícaro'],
            ['name' => 'Jalapa'],
            ['name' => 'Macuelizo'],
            ['name' => 'Mozonte'],
            ['name' => 'Murra'],
            ['name' => 'Ocotal'],
            ['name' => 'Quilalí'],
            ['name' => 'San Fernando'],
            ['name' => 'Santa María'],
            ['name' => 'Wiwilí'],
        ]);
        $c->departments()->create(['name' => 'Río San Juan'])->towns()->createMany([
            ['name' => 'El Almendro'],
            ['name' => 'El Castillo'],
            ['name' => 'Morrito'],
            ['name' => 'San Carlos'],
            ['name' => 'San Juan del Norte'],
            ['name' => 'San Miguelito'],
        ]);
        $c->departments()->create(['name' => 'Rivas'])->towns()->createMany([
            ['name' => 'Altagracia'],
            ['name' => 'Belén'],
            ['name' => 'Buenos Aires'],
            ['name' => 'Cárdenas'],
            ['name' => 'Moyogalpa'],
            ['name' => 'Potosí'],
            ['name' => 'Rivas'],
            ['name' => 'San Jorge'],
            ['name' => 'San Juan del Sur'],
            ['name' => 'Tola'],
        ]);
    }
}
