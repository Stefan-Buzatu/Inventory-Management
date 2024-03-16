<?php

$sname= "127.0.0.1";
$unmae= "root";
$password = "123";

$db_name = "administrare_inventar";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}

