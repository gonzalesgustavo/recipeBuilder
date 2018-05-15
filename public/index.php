<?php

/****
  Front Door Access
	"Main Entry"
****/

/*****
	@pseudo-> Template engine
	Note ... Twig
******/
require_once dirname(__DIR__) . '/vendor/vendor/autoload.php';

spl_autoload_register(function ( $class ) 
{
 	$root = dirname(__DIR__); //deals with parent directory
 	$file = $root . '/' . str_replace('\\', '/', $class) . '.php';
 	if(is_readable($file))
 	{
 		require $root . '/' . str_replace('\\', '/', $class) . '.php';
 	}

});

/*****
	@pseudo-> Error handling catch errors and display them the best I can with php
	Note ... Php and error handling are unreliable
******/
sert_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/*****
	@psuedo-> seperate the route catcher and place in a class
	Routing...
******/
$router = new Router();

/*****
	@psuedo-> map routes 
	Routes ...
******/
$router->add('', ["controller" => 'Home', 'action' => 'index']);
$router->add('Posts', ["controller" => 'Posts', 'action' => 'index']);
$router->add('Posts/new', ["controller" => 'Posts', 'action' => 'new']);


/*****
	@pseudo-> handle mapped routes
	Note ... handle foul or missmatch routes -- error page possibly
******/

$url = $_SERVER['QUERY_STRING'];
$router->route_handler( $url );

?>