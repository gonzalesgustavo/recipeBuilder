<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recipes</title>
</head>
<body>
	<h1>Welcome</h1>
	<p>hello <?php echo htmlspecialchars($name); ?></p>
	<ul>
		<?php foreach ($hobbies as $hobby): ?>
			<li><?php echo htmlspecialchars($hobby); ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>