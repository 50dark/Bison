<?php

use App\Taille;
use Illuminate\Database\Seeder;

class TaillesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $tailles = ['xs','s','m','l','xl','xxl'];
//        $tailles = ['36','38','40','42','44','46'];
//        $tailles = ['36','37','38','40','42','44','46','48','50',];
        $tailles = ['54-55','55-56','56-57','57-58','58-59','59-60','60-61','61-62','62-63',];
        foreach ($tailles as $t) {
            $taille = new Taille();
            $taille->nom = $t;
            $taille->type_id = 4;
            $taille->save();
        }
        //
    }
}
