<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Palestra extends Model
{
	protected $table = 'palestras'; 
    protected $fillable = ['id','palestrante_id','event_id','title', 'apresetation','valor','start_date','end_date'];
}
