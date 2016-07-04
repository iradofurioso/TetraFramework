<?php

namespace TetraFramework\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use TetraFramework\Core\Router;


class Dispatcher 
{ 
	
	private static $routes;


	public static function init()
	{
		$context = '';
		$request = '';
		$matcher = '';

		$request = Request::createFromGlobals();
		
		Router::init();

		self::$routes = Router::get();
		
		$context = new Routing\RequestContext();

		$context->fromRequest($request);

		$matcher = new Routing\Matcher\UrlMatcher(self::$routes, $context);

		
		extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
		include sprintf(APPROOTPATH . 'controllers/%s.php', $_route);
	}
}
