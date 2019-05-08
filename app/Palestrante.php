<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Palestrante extends Model
{
	protected $fillable = ['event_id','nome','instituicao','apresentacao', 'url','cargo','foto_perfil'];
}
