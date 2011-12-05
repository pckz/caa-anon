<?php
$adminuser = "admin";
$adminpass = "c44-1nf0";


function loginpage($error) {
	echo "<html>\n<head>\n<title>Panel administracion OpinaICI</title>\n";
	echo "</head>\n<body>\n";
	echo "<table style='width:100%;height:100%;'>\n<tr>\n<td align='center'>\n";
	echo "<form action='" . $_SERVER['REQUEST_URI'] . "' method='post'>\n";
	echo "<table border='1' width='300' cellspacing='0' cellpadding='4'><tr>\n";
	$formtitle = "Panel administracion OpinaICI";
	if($error) $formtitle = "Credenciales erroneas!";
	echo "<th colspan='2'>" . $formtitle . "</th>\n";
	echo "</tr><tr>\n";
	echo "<td><p><b><label for='username'>User:</label></b></p></td>\n";
	echo "<td><input type='text' name='username' id='username' size='30'></td>\n";
	echo "</tr><tr>\n";
	echo "<td><p><b><label for='password'>Pass:</label></b></p></td>\n";
	echo "<td><input type='password' name='password' id='password' size='30'></td>\n";
	echo "</tr><tr>\n";
	echo "<td><b>Login:</b></td>\n";
	echo "<td><input type='submit' value=' Login &raquo; ' name='login'></td></tr></table></form>\n";
	echo "</td>\n</tr>\n</table>\n</body>\n</html>";
	exit;
}

$username = $_POST['username'];
$password = $_POST['password'];
$login    = $_POST['login'];

session_start();
if($_SERVER['QUERY_STRING'] == "logout") {
	unset($_SESSION['authuser']);
	header("Location: http://" . $_SERVER['HTTP_HOST']);
	exit;
}
if($_SESSION['authuser'] != $adminuser) {
	if(!$login) {
		loginpage(false);
	}
	elseif(($username != $adminuser) || ($password != $adminpass)) {
		loginpage(true);
	}
	else {
		$_SESSION['authuser'] = $adminuser;
		header("Location: " . $_SERVER['REQUEST_URI']);
	}
}
// else we enter the restricted area
session_write_close();
?>