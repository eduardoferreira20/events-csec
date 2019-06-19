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
            'QRpassword'=>'Dammy-CODE-1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP'
        ]);

        DB::table('users')->insert([
            'name' => 'Rafael Ferreira Pinto',
            'email' => 'animedudu12345@gmail.com',
            'password' => Hash::make('123456'),
            'instituicao' => 'Universidade de Pernambuco',
            'nacionalidade' => 'Brasileiro',
            'tipo' => '1',
            'documento' => '57418644953',
            'QRpassword'=>'Dammy-122-1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP'
        ]);

    }
}
