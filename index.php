<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

include "connect.php";
include "comment.class.php";


/*
/	Select all the comments and populate the $comments array with objects
*/

$comments = array();
$result = mysql_query("SELECT * FROM comments ORDER BY id DESC");

while($row = mysql_fetch_assoc($result))
{
	$comments[] = new Comment($row);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OpinaICI.org</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>

<h1>OpinaICI.org</h1>

<div id="main">
	<div id="addCommentContainer">
		<form id="addCommentForm" method="post" action="">
					<p>Opina!</p>
					<label for="body"></label>
        	<textarea name="body" id="body" cols="20" rows="5"></textarea>
	        	<span>
							<label for="name" >	Nombre</label>
	        		<input type="text" name="name" id="name" />
						</span>
						<span>
	          	<label for="email">Email</label>
	          	<input type="text" name="email" id="email" />
						</span>
						<span>
	          	<label for="url">Sitio web (no requerido)</label>
	          	<input type="text" name="url" id="url" />
						</span>

	            <input type="submit" id="submit" value="Opinar" />
	    </form>
	</div>
<?php

/*
/	Output the comments one by one:
*/

foreach($comments as $c){
	echo $c->markup();
}

?>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>
