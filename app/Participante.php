<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
use App\User;

class Participante extends Model
{
	protected $table = 'users';
	protected $fillable = ['id','name', 'email','documento'];

	public function evento(){
        return $this->hasMany('App\Event');
    }
}