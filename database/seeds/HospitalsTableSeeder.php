<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(\App\Hospital::count()==0)
      {
        DB::table('hospitals')->insert([
          'id' => 1,
          'name' => 'Oswaldo Cruz'
        ]);

        DB::table('hospitals')->insert([
          'id' => 2,
          'name' => 'Santa Catarina'
        ]);

        DB::table('hospitals')->insert([
          'id' => 3,
          'name' => 'São Camilo - Ipiranga',
        ]);

        DB::table('hospitals')->insert([
          'id' => 4,
          'name' => 'São Camilo - Pompéia',
        ]);

        DB::table('hospitals')->insert([
          'id' => 5,
          'name' => 'São Camilo - Santana'
        ]);
      }
    }
}
