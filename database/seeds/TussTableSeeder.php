<?php

use Illuminate\Database\Seeder;

class TussTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tuss_csv = fopen('storage/data/tuss.csv','r');
        while($linha = fgetcsv($tuss_csv,0,';'))
        {
            DB::table('tuss')->insert(['id'=>$linha[0],'description'=>$linha[1]]);
        }
    }
}
