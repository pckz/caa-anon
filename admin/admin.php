<html>

  <head>
    <title>Administracion OpinaICI</title>
    <link rel="stylesheet" type="text/css" href="admin.css" />
  </head>

  <body>
  <div id="container">
  <?php
  require_once("login.php");
  $authuser = $_SESSION['authuser'];
  include_once('simpleCMS.php');
  $obj = new simpleCMS();
  $obj->host = 'localhost';
  $obj->username = 'root';
  $obj->password = 'root';
  $obj->table = 'opinaici';
  $obj->connect();
  
  ?>
  <a href="http://www.opinaici.org"><img border="0" src="/img/logo_thumb.png"/></a>
  <h1>Bienvenido, <?=$authuser;?></h1>
  <span id="logout"><a href="login.php?logout">Logout</a></span>
  
  <?php
  $pagina = 1;
  if (isset($_GET['id']) ) {
  	echo $obj->delete_id($_GET['id']); 
  } 

  echo $obj->display_public();
  

?>
  </div>
  </body>

</html>