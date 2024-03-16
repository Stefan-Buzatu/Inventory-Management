<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Inregistrare</title>

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
            align-items: center;
            text-align: center;
            height: 80vh;
            justify-content: center;
            flex-direction: column;
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
            max-width: 400px;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="box">
    
    <h1>Inregistrare</h1>
    
    <form action="inregistrare.php" method="post">
        <label for="nume_utilizator">Numele utilizatorului</label>
        <input type="text" name="nume_utilizator" id="nume_utilizator">
        
        <label for="parola">Parola</label>
        <input type="password" name="parola" id="parola">

        <label for="confirmare_parola">Confirmare parola</label>
        <input type="password" name="confirmare_parola" id="confirmare_parola">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="numar_telefon">Numar telefon</label>
        <input type="text" name="numar_telefon" id="numar_telefon">
        
        <button type="submit" name="inregistreaza-ma">Inregistreaza-ma</button>
    </form>
    </div>
</body>
</html>


<?php

session_start();

include("../baza_de_date/db_connection.php");
include("functii.php");

if(isset($_POST["inregistreaza-ma"])){
    $nume_utilizator=$_POST['nume_utilizator'];
	$parola=$_POST['parola'];
    $confirmare_parola=$_POST['confirmare_parola'];
    $email=$_POST['email'];
    $numar_telefon=$_POST['numar_telefon'];

    if((!empty($nume_utilizator)) && !(empty($parola)) && !(empty($confirmare_parola)) && !(empty($email)) && !(empty($numar_telefon))){
        $duplicate=mysqli_query($conn,"SELECT * FROM utilizatori WHERE email='$email' OR numar_telefon='$numar_telefon'");
        if(mysqli_num_rows($duplicate)){
            echo "<script>alert('Aceste date apartin altui utilizator');</script>";
        }
        else {
        if($parola==$confirmare_parola)
        {

            $query="INSERT INTO utilizatori (nume_utilizator,parola,email,numar_telefon,status) VALUES ('$nume_utilizator','".sha1($parola)."','$email','$numar_telefon',2)";
            mysqli_query($conn,$query);
            header("Location: login.php");

        }
        else
        {
            echo "<script>alert('parola nu coincide');</script>";
        }
    }
    }
    else
    {
        echo '<script type="text/JavaScript">  
     alert("Toate campurile trebuiesc completate"); 
     </script>' 
; 
    }
}

?>


