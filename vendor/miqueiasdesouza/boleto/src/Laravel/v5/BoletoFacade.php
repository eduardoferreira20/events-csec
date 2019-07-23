<?php namespace Miqueiasdesouza\Boleto\Laravel\v5;

use Illuminate\Support\Facades\Facade;

class BoletoFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'Miqueiasdesouza\Boleto\Boleto'; }

}
