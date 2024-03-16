<?php

session_start();

if(isset($_SESSION['nume_utilizator']))
{
	unset($_SESSION['nume_utilizator']);

}

header("Location: login.php");
die;