<?php

namespace TetraFramework\Core;

use Symfony\Component\Routing;


class Router 
{
	
	private static $routes; 


	/**
	 * @todo colocar o conteúdo vindo de uma tabela de rotas.
	 */
	public static function init()
	{
		self::$routes = new Routing\RouteCollection();
		self::$routes->add('ola', new Routing\Route('/ola'));
	}


	public static function get()
	{
		return self::$routes;
	}

}
