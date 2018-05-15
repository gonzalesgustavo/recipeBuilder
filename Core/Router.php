<?php
namespace Core;
/*****
	@pseudo-> route handler {take care of requests} might be useful as a class
	          for MVC functionality
	Note ...  Handle routes sent in from the main controller
******/

class Router
{
	/*****
		Route Array->
	******/
	protected $routes = [];

	/*****
		@pseudo-> Somehow compare possibly use json to match 
		Note ... {{Try and use private or protected instead of public}}
		@crash ... check regex might cause problems
	******/
	protected $params = [];

	public  function add ( $route, $params = [] ) 
	{
	 	$route = preg_replace('/\//', '\\/', $route);
	 	$route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-]+)', $route);
	 	$route = preg_replace('/\{([a-z]+):([^\}]+)\}/','(?P<\1>\2)', $route);
	 	$route = '/^' . $route . '$/i';
	 	$this->routes[$route] = $params;
	} 
	/*****
		for -> @testing Funciton
	******/
	public function getRoutes (  )
	{
		return $this->routes;
	}
	/*****
		@pseudo-> *lateral development* not in psuedo code
		Note ... originally used a for loop, foreach trial/ regex trial
		@crash ... Regex might cause problem -> line 39
	******/
	public function match ( $url )
	{
		foreach ($this->routes as $route => $params) 
		{
			if(preg_match($routes, $url, $matches))
			{
				foreach ($matches as $key => $value) 
				{

					if(is_string($key))
					{
						$params[$key] = $value;
					}
				}
		$this-params = $params;
		return true;	
			}
		}
		return false;
	}

	/*****
		@pseudo-> *lateral development* not in psuedo code
		Note ... Testing purposes 
	******/
	public function getParams (  )
	{
		return $this->params;
	}

	/*****
		@pseudo-> send user to correct route. *lateral development* Create a handler for linking controller and routes
		Note ... Previously called route_lister ... 
	******/
	public function route_handler ( $url )
	{
		$url = $this->removeQSVariables($url);
		if($this->match($url))
		{
			$controller = $this->params['controller']; //extract controller from params array
			$controller = $this->convertToProperClassName("controller"); //make sure the format is correct
			$controller = $this->getNamespace() . $controller;
			//make sure class exists 
			if(class_exists($controller))
			{
				$controller_obj = new $controller($this->params); //create an object of class
				$action = $this->params['action']; //link an action @warning-might break here
				$action = $this->convertToCamelCase( $action );
				//is callable makes sure the function is accessible *error handling
				if(preg_match('/action$/i', $action) == 0)
				{
					$controller_obj->$action();//call the action for the class
				}
				else
				{
					throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
				} //end if else 2
			}
			else
			{
				throw new \Exception("Controller class $controller not found");
			} //end of if else 1
		}
		else
		{
			throw new \Exception('no route matched.');
			//@404 or 401 error
		}
	}
	/*****
		@pseudo-> *lateral development* 
		Note ... Handles the class name standart StudlyCaps
	******/
	public function convertToProperClassName ( $string )
	{
		return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
	}
	/*****
		@pseudo-> *lateral development* 
		Note ... Turn strings to camelcase for controller factory
	******/
	public function convertToCamelCase ( $string )
	{
		return lcfirst($this->convertToProperClassName( $string ));
	}
	/*****
		@pseudo-> *lateral development* 
		Note ... handles query string variables remove before route tutorial
	******/
	protected function removeQSVariables ( $url )
	{
		if($url != '')
		{
			$parts = explode('&', $url, 2);
			if(strpos($parts[0], '=') === false)
			{
				$url = parts[0];
			} 
			else
			{
				$url = '';
			}
		}
		return $url;
	}
	/*****
		@pseudo-> *lateral Dev*
		Note ... set defined namespaces 
	******/
	protected function getNamespace (  )
	{
		$namespace = 'MVC\Controllers\\';
		if(array_key_exists('namespace', $this->params))
		{
			$namespace .= $this->params['namespace'] . '\\';
		}
		return $namespace;
	}
}
?>