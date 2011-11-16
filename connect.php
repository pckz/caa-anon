<?php

/* Database config */

$db_host		= 'localhost';
$db_user		= 'opinaici';
$db_pass		= 'opinaici';
$db_database		= 'opinaici'; 

/* End config */


$link = @mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');

mysql_query("SET NAMES 'utf8'");
mysql_select_db($db_database,$link);

?>