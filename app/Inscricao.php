<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Event;

class Inscricao extends Model
{
	protected $fillable = ['id','user_id','event_id','comprovante_path', 'status'];

	
	public function user(){
		
		return $this->belongsTo('App\User','user_id');
	}

	public function evento(){
		
		return $this->belongsTo('App\Event','event_id');
	}

}
