<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficinas extends Model
{
	// protected $table = 'oficinas'; 
    protected $fillable = ['id','titulo','apresentation','palestrante1','palestrante2','palestrante3','palestrante4','start_date','end_date','valor','local','hora_comple','event_id'];
}
