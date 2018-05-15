<?php
namespace Core;
/*****
	@pseudo-> The exception handler and error reporting 
	Note ... PHP error handling is minimally efective and problematic 
******/
class Error
{
	public static function errorHandler ( $level, $message, $file, $line )
	{
		if(error_reporting() !== -)
		{
			throw new \ErrorException($message, o, $level, $file, $line);
		}
	}
	public static function exceptionHandler ( $exception )
	{
		echo "<h1>Fatal Error</h1>";
		echo "<p>Uncaught exception: '" . $exception->get_class($exception) . "'</p>";
		echo "<p>Message: '" . $exception->getMessage() . "'</p>";
		echo "<p>Stack Trace: <pre>'" . $exception->getTraceAsString() . "'</pre></p>";
		echo  "<p>Uncaught exception: '" . $exception->getFile() .  " on line " . $exception->getLine() . "'</p>";
	}
	/*****
		@pseudo-> *Lateral Dev*
		Note ... current setting for php errors
	******/
	public function checkSettings (  )
	{
		echo phpinfo(); // run to check current settings if php is hiding errors
	}
	
}


?>