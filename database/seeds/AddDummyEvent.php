<?php

use Illuminate\Database\Seeder;
use App\Event;

class AddDummyEvent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	['title'=>'Demo Event-1', 'start_date'=>'2019-03-10', 'end_date'=>'2019-01-10', 'all_day'=>'1', 'user_id' => '1', 'e_pago'=>'1','hora_comple'=>'8H'],
        	['title'=>'Demo Event-2', 'start_date'=>'2019-03-11', 'end_date'=>'2019-01-11', 'all_day'=>'1', 'user_id' => '1', 'e_pago'=>'0','hora_comple'=>'2H'],
        	['title'=>'Demo Event-3', 'start_date'=>'2019-03-12', 'end_date'=>'2019-01-12', 'all_day'=>'1', 'user_id' => '1', 'e_pago'=>'0','hora_comple'=>'36H'],
        	['title'=>'Demo Event-4', 'start_date'=>'2019-03-13', 'end_date'=>'2019-01-13', 'all_day'=>'1', 'user_id' => '1', 'e_pago'=>'1','hora_comple'=>'5H'],
        ];
        foreach ($data as $key => $value) {
        	Event::create($value);
        }
    }
}
