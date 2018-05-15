<?php
namespace MVC\Controllers;

// use statements
use \Core\View;
use MVC\Models\Posts;

/*****
	@pseudo-> Deal with recipe posts
	Note ... Aim for a single page app if possible
******/

class Posts extends \Core\Controller
{
	/*****
		@pseudo-> link to view. show posts page.
		Note ... view route *possibly singe page web app
	******/
	public function indexAction (  )
	{
		$posts = Post::getAll();
		echo "hello from index controller";
		View::renderTemplate('Posts/index.php', [
			'name'    => 'John',
			'hobbies' => ['skiing', 'smoking', 'sleeping']
		]);

	}
	public function getData()
	{
		//get data from db
		//loop through data recipes
		//display data in the view
	}
	public function addData (  )
	{
		//deal with post
		//save to database
	}
	/*****
		@pseudo-> add new post. Data passing
		Note ... Hopefully template
	******/
	public function addNewAction (  )
	{
		echo "Hellow from add new action in post";
	}
	/*****
		@pseudo-> edit post
		Note ... edit recipes
	******/
	public function editAction (  )
	{
		echo "Hello from the edit action";
	}
}
?>