<?php
namespace MVC\Models;
use PDO;
/*****
	@pseudo-> Connect to db, query db, ship db
	Note ... Try and make the database connection simple and easy, don't complicate it (&note to self)
******/

class Post EXTENDS \Core\Model
{
	public static function getAll (  )
	{
		/*****
			@pseudo-> set up connection variable (plan to seperate later)
			Note ... turn this into a funciton usable throughout the other models
		******/
		try 
		{
			$db 		= static::getDB();
			$stmt 		= $db->query('SELECT * FROM  recipe_log ');//query
			$results 	= $stmt->fetchAll(PDO::FETCH_ASSOC);//prepare data
			return 	$results; //export data for use elsewhere
		} 
		catch (PDOException $e) 
		{
			echo $e->getMessage();//catch errors the best one can with php and it's crummy error handling
		}
	}
	public static function insert ( $query )
	{
		//prepare db query
		//insert data
		//return status
	}
}

?>