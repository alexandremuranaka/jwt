<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
              'name' => 'Santa Catarina',
          ]);
      }
    }
}
