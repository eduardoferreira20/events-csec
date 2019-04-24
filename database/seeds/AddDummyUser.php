<?php

use Illuminate\Database\Seeder;
use App\User;

class AddDummyUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Eduardo José Ferreira de Souza',
            'email' => 'ejfs@ecomp.poli.br',
            'password' => Hash::make('123456'),
            'instituicao' => 'Universidade de Pernambuco',
            'nacionalidade' => 'Brasileiro',
            'tipo' => '1',
            'documento' => '70555713407',
        ]);
    }
}
