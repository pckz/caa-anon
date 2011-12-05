<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

include "connect.php";
include "comment.class.php";
$postperpag = 10;

/*
/	Select all the comments and populate the $comments array with objects
*/



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if (!isset($_GET['id'])) echo '<title>OpinaICI.org</title>' ; ?>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<center>
<a href="http://www.opinaici.org"><img border="0" src="img/banner.png"/></a>
</center>
<div id="info">
<a href="?about">Qué es esto?</a>
</div>

	<div id="main">
<?php
/*
/	Output the comments one by one:
*/

if (isset($_GET['id'])&&ctype_digit($_GET['id'])) {
	$comments = array();
	$result = mysql_query("SELECT * FROM comments WHERE id = '".$_GET['id']."' LIMIT 0,1");

	while($row = mysql_fetch_assoc($result))
	{
		$comments[] = new Comment($row);
	}
	foreach($comments as $c){
		echo '<br /><br /><br />';
		echo $c->markup(true);
	}
}
else if(isset($_GET['about'])){
	?>
	<br /><br />
	<div id="comment" class="comment">
	
		Esta página está dirigida a los estudiantes de Ing. Civil en Informática para canalizar sus comentarios, sugerencias, entre otros, para poder formar una visión de lo que los estudiantes ven en la carrera, falencias, problemas, pero principalmente fomentar el debate, para poder transformar estos argumentos en hechos reales.
<br /><br />
		Si estudias Informática y quieres dar tu opinión anónimamente, estas en el lugar adecuado.
		</div>
	<?php
} 
else {
	?>
		<div id="addCommentContainer">
			<form id="addCommentForm" method="post" action="">

						<label for="body"></label>
	        	<textarea name="body" id="body" cols="20" rows="5"></textarea>
		        	<span>
								<label  for="name" >	Nombre</label>
		        		<input style="width:560px;" type="text" name="name" value="Anónimo" id="name" />
							</span>
							<div style="display:none;">
							<span>
							          	<label for="email">Email</label>
							          	<input type="text" name="email" id="email" value="patch@display.none"/>
												</span>
												<span>
							          	<label for="url">Sitio web (no requerido)</label>
							          	<input type="text" name="url" id="url" />
							</span>
							</div>

		          <input type="submit" id="submit" value="Opinar" />
		    </form>
		</div>
	<?php
	$comments = array();
	if (isset($_GET['pag'])&&ctype_digit($_GET['pag'])&&$_GET['pag']>0) {
		$pag = ($_GET['pag']-1)*$postperpag;
		$result = mysql_query("SELECT * FROM comments ORDER BY id DESC limit $pag,$postperpag");
	}
	else 
		$result = mysql_query("SELECT * FROM comments ORDER BY id DESC limit 0,$postperpag");
	while($row = mysql_fetch_assoc($result))
	{
		$comments[] = new Comment($row);
	}
	foreach($comments as $c){
		echo $c->markup();
	}
}

?>
</div>

<center>
<?php
if (!isset($_GET['id'])&&!isset($_GET['about'])) {
/* paginacion */
$result = mysql_query("SELECT count(*) FROM comments");
$row = mysql_fetch_array($result);
if (isset($_GET['pag']) && 1 < $_GET['pag']) {
	echo '<a href="?pag='.($_GET['pag']-1).'">anterior</a> / ';
}
?>
página <?php
	if (isset($_GET['pag'])&&ctype_digit($_GET['pag'])&&$_GET['pag']>0) echo $_GET['pag'];
	else echo '1';
?> de <?php

echo ceil($row[0]/$postperpag);

if ($row[0]/$postperpag > $_GET['pag']&&ceil($row[0]/$postperpag)!=1) {
	if (isset($_GET['pag'])) echo ' / <a href="?pag='.($_GET['pag']+1).'">siguiente</a>';
	else echo ' / <a href="?pag=2">siguiente</a>';
}
}
?> 
<br /><br />
</center>
<center><img src="img/logo_thumb.png" /></center>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>
