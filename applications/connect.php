<?php

if(!defined("PATH_FILE")){ 	die("You can not access direct to this file...");
}
 include(__PATH . "class.mysql.php");
 global $user, $cookie, $prefix;
$db = new sql_db($dbhost, $dbuser, $dbpass, $dbname, false);
if(!$db->db_connect_id) {
echo mysql_error();
    //die("<br><br><center><br>Error: Can not connect to database...</center>");
}
echo mysql_error();
?>