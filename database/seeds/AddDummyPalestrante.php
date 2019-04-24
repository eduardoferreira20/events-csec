<?php

use Illuminate\Database\Seeder;
use App\Palestrante;

class AddDummyPalestrante extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nome'=>'Demo-1', 'instituicao'=>'Escola Politécnica de Pernambuco', 'event_id'=>'1'],
            ['nome'=>'Demo-2', 'instituicao'=>'CSEC', 'event_id'=>'1'],
            ];
        foreach ($data as $key => $value) {
            Palestrante::create($value);
        }    
    }
}
