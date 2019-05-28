<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Event extends Model
{
	protected $table = 'events';
	protected $fillable = ['id','user_id','title','start_date','end_date', 'all_day', 'apresentation','hora_comple','e_pago','valor','local','cidade'];

	public function palestrante(){
		return $this->hasMany('App\Palestrante');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function deleta(){
		foreach ($this->palestrante as $evento){
			$evento->delete();
		}
		return true;
	}
}