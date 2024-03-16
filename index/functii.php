<?php

function check_login($con)
{

	if(isset($_SESSION['email']))
	{

		$email = $_SESSION['email'];
		$query = "select * from utilizatori where email = '$email'";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$utilizator_data = mysqli_fetch_assoc($result);
			return $utilizator_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}