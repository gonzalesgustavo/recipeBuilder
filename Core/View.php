<?php
/*****
	@pseudo-> view handle for posts
	Note ... handles the chat between controller and view
******/
class View
{
	/*****
		@pseudo-> view connect
		Note ... get and connect the view files
	******/
	public static function render ( $view, $args = [] )
	{
		extract($args, EXTR_SKIP);
		$file = "../MVC/Views/$view";
		if(is_readable($file))
		{
			require $file;
		}
		else
		{
			throw new \Exception("$file not found");
		}
	}
	/*****
		@pseudo-> Render Engine renderer
		Note ... Twig render function (ejs if available would have been better)
	******/
	public static function renderTemplate ( $template, $args = [] )
	{
		static $twig = null;
		if($twig === null)
		{
			$loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/MVC/Views');
			$twig    = new \Twig_Environment($loader);
		}
		echo $twig->render($templae, $args);
	}
}
?>