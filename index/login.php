<?php
session_start();

include("../baza_de_date/db_connection.php");
include("functii.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

	$nume_utilizator=$_POST['nume_utilizator'];
	$parola=$_POST['parola'];

	if(!empty($nume_utilizator) && !empty($parola))
		{


$query="SELECT * FROM utilizatori WHERE nume_utilizator LIKE BINARY '$nume_utilizator' AND parola LIKE BINARY '".sha1($parola)."';";

$result = mysqli_query($conn,$query);

	if($result && mysqli_num_rows($result) > 0)
	{
		$utilizator_data = mysqli_fetch_assoc($result);
		
		$_SESSION['email'] = $utilizator_data['email'];
		header("Location: index.php");
		die;
		
	}

			
echo "<script>alert('date incorecte');</script>";
		}else
		{
			echo "<script>alert('date incorecte');</script>";
		}

$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logare</title>
    <style>
        .box {
            background-color: #f4f4f4;
            border-radius: 8px;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
            background-image: url('../poze_site/pexels-pixabay-236705.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            max-width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #f4f4f4;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #f4f4f4;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="box">
    <h1>Logare</h1>
    
    <form action="login.php" method="post">
        <label for="nume_utilizator">Numele utilizatorului</label>
        <input type="text" name="nume_utilizator" id="nume_utilizator" required>
        
        <label for="parola">Parola</label>
        <input type="password" name="parola" id="parola" required>
        
        <button type="submit">Logare</button> 
    </form>

    
        <form action="inregistrare.php">
            <button>Inregistrare</button>
        </form>
    
</div>
</body>
</html>
