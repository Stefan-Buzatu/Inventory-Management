<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Adaugare Furnizor</title>

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
    
    <h1>Adaugare furnizor</h1>
    
    <form action="add_provider.php" method="post" enctype="multipart/form-data">
        <label for="nume_furnizor">Numele furnizorului</label>
        <input type="text" name="nume_furnizor" id="nume_furnizor">

        <label for="oras">Oras</label>
        <input type="text" name="oras" id="oras">

        <label for="telefon">Numarul de telefon</label>
        <input type="text" name="telefon" id="telefon">

        <label for="iban">IBAN</label>
        <input type="text" name="iban" id="iban">
    
        <button type="submit" name="adauga_furnizor">Adauga furnizor</button>
    </form>
    </div>
</body>
</html>


<?php

session_start();

        include("../baza_de_date/db_connection.php");
        include("../index/functii.php");

        $utilizator_data = check_login($conn);



if(isset($_POST["adauga_furnizor"])){
    $nume_furnizor=$_POST['nume_furnizor'];
	$oras=$_POST['oras'];
    $telefon=$_POST['telefon'];
    $iban=$_POST['iban'];

    if((!empty($nume_furnizor)) && !(empty($oras)) && !(empty($telefon)) && !(empty($iban))){  
        
    $stmt = $conn->prepare("INSERT INTO furnizori (nume, oras, tel, iban) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nume_furnizor, $oras, $telefon, $iban);
    $stmt->execute();
    $stmt->close();

    header("Location: providers.php");

    }
    else{
        echo "Toate campurile trebuiesc completate";
    }
}
?>