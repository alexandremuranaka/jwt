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
          'name' => 'Oswaldo Cruz',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('hospitals')->insert([
          'id' => 2,
          'name' => 'Santa Catarina',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('hospitals')->insert([
          'id' => 3,
          'name' => 'São Camilo - Ipiranga',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('hospitals')->insert([
          'id' => 4,
          'name' => 'São Camilo - Pompéia',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('hospitals')->insert([
          'id' => 5,
          'name' => 'São Camilo - Santana',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
      }
    }
}
