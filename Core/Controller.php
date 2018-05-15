<?php
namespace Core;

/*****
	@pseudo-> Main controller -> data transfer controller manager
	Note ... Needed for passing params 
******/
abstract class Controller
{
	/*****
		@pseudo-> variables
		Note ... route parameters array possibly assosiative array
	******/
	protected $route_params = []
	/*****
		@pseudo-> function to load the array
		Note ... *Lateral Dev* moved into Contructor for class
	******/
	public function __construct ( $route_params )
	{
		$this->route_params = $route_params;
	}
	public function __call ( $name, $args )
	{
		$method = $name . 'Action';
		if(method_exists($this, $method))
		{
			if($this->before() !== false)
			{
				call_user_func_array([$this, $method], $args);
				$this->after();
			}
		}
		else
		{
			throw new \Exception("Method $method not found in controller " . getclass($this));
		}
	}
	/*****
		@pseudo-> *lateral dev*
		Note ... Handles code that fires before an action is calles
	******/
	protected function before (  )
	{
		//
	}
	/*****
		@pseudo-> *lateral Dev*
		Note ... Handles code needed to run after the action method is calles
	******/
	protected function after (  )
	{
		//
	}
}//end of class
?>