<html>

  <head>
    <title>Administracion OpinaICI</title>
    <link rel="stylesheet" type="text/css" href="admin.css" />
  </head>

  <body>
  <div id="container">
  <?php
  require_once("../connect.php");
  require_once("login.php");
  $authuser = $_SESSION['authuser'];
  include_once('simpleAdmin.php');
  $obj = new simpleAdmin();
  
  ?>
  <a href="http://www.opinaici.org"><img border="0" src="/img/logo_thumb.png"/></a>
  <h1>Bienvenido, <?=$authuser;?></h1>
  <span id="logout"><a href="login.php?logout">Logout</a></span>
  
  <?php
  $pagina = 1;
  if (isset($_GET['id']) ) {
  	echo "<span class='mensaje'>".$obj->delete_id($_GET['id'])."</span>"; 
  } 

  echo $obj->display_public();
  

?>
  </div>
  </body>

</html>