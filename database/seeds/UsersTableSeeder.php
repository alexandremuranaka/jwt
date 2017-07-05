<?php

use Illuminate\Database\Seeder;
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
      if(\App\User::count()==0)
      {
          DB::table('users')->insert([
              'name' => 'John Doe',
              'email' => 'john.doe@gmail.com',
              'cellphone' => '11999999999',
              'photo' => '/assets/avatar/1499112171.jpg',
              'password' => bcrypt('123456'),
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]);
      }
    }
}
