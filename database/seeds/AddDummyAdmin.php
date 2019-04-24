<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AddDummyAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Administrador CSEC',
            'email' => 'dex@poli.br',
            'password' => Hash::make('123456'),
        ]);
    }
}
