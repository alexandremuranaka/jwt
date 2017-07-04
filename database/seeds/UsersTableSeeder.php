<?php

use Illuminate\Database\Seeder;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(\App\User::count()==0)
      {
          DB::table('users')->insert([
              'name' => 'John Doe',
              'email' => 'john.doe@gmail.com',
              'cellphone' => '(11)99999-9999',
              'photo' => '/assets/avatar/1499112171.jpg',
              'password' => bcrypt('123456'),
          ]);
      }
    }
}
