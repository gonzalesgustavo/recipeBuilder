<?php
namespace Core;

/***************
	Comment --> uses
***************/
use PDO;
use MVC\Config;
/*****
	@pseudo-> *lateral Dev*
	Note ... Clean up db connection, decentralize connection and extend where necessary (@optimization)
******/

abstract class Model
{
	/*****
		@pseudo-> connection
		Note ... Get connection route elsewhere
	******/
	 public static function getDB (  )
	{
		static $db = null;
		if($db === null)
		{
			$dbs		= 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8'; 
			$db 		= new PDO($dbs, Config::DB_USER, Config::DB_PASS);//connect
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//for error catching @error
			return 	$db; //export data for use elsewhere
		}
	}
}

?>