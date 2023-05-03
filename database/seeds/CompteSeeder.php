<?php

use Illuminate\Database\Seeder;
use App\Compte;

class CompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Compte::class, 200)->create();
    }
}
