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
<!--[if IE]>
<meta HTTP-EQUIV="REFRESH" content="0; url=http://www.opinaici.org/ie.php">
<![endif]-->
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="styles.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<!--  Fancybox -->
<link rel="stylesheet" href="lib/fancybox/jquery.fancybox.css?v=2.0.3" type="text/css" media="screen" />
<script type="text/javascript" src="lib/fancybox/jquery.fancybox.pack.js?v=2.0.3"></script>
<!-- Google Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27524852-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<center>
<a href="http://www.opinaici.org"><img border="0" src="img/banner.png"/></a>
</center>
<div id="info">
<a class="fancybox" href="#inline">Qu&#233; es esto?</a>
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
		if ($c->is_admin == '1'){
			echo $c->markup(false, true);
		} else echo $c->markup();
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
<div id="inline">
<span id="inline-image"><img src="img/logo_thumb.png" /></span>
<span id="inline-text">Esta p&#225;gina est&#225; dirigida a los estudiantes de Ing. Civil en Inform&#225;tica UACh para canalizar sus comentarios, cr&#237;ticas, disgustos y sugerencias respecto a su carrera, pero sobre todo para fomentar el debate y transformar estos argumentos en hechos reales.
<br/><br/>Si estudias Inform&#225;tica en la UACh y quieres dar tu opini&#243;n ya sea con tu nombre real o como an&#243;nimo, est&#225;s en el lugar adecuado</span>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox({
			maxWidth	: 600,
			maxHeight	: 400,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: true,
			closeClick	: false,
			openEffect	: 'fade',
			closeEffect	: 'fade'
		});
	});
</script>

</body>
</html>
