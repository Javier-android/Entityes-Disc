<!DOCTYPE html>
<html lang="en" dir"ltr">
	<head>
	<meta charset="utf8">
	<title></title>
	</head>
	<body>
	<h1>{titulo} New Genre</h1>
	<h2></h2>
	<form class="" action="{base_url}/disco/public/genre/update" method="post">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" value="{name}" minlength="3" maxlength="255">
		<input type="hidden" name="id" id="id" value="{id}">
		<button type="submit" name="button">Save</button>
	</form>
	</body>
</html>