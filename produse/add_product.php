<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Adaugare Produs</title>

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
    
    <h1>Adaugare produs</h1>
    
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <label for="nume_produs">Numele produsului</label>
        <input type="text" name="nume_produs" id="nume_produs">

        <label for="pret">Pret(RON)</label>
        <input type="text" name="pret" id="pret">

        <label for="cantitate">Numarul de bucati</label>
        <input type="text" name="cantitate" id="cantitate">

        <label for="descriere">Descriere</label>
        <input type="text" name="descriere" id="descriere">

        <select class="form-select" aria-label="Default select example" name="id_categorie" id="id_categorie">
        <option value="0" selected>Alege categoria</option>
        <?php

        session_start();

        include("../baza_de_date/db_connection.php");
        include("../index/functii.php");

        $utilizator_data = check_login($conn);

        $query = "SELECT id_categorie, nume FROM categorii";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='{$row['id_categorie']}'>{$row['nume']}</option>";
            }
        ?>
        </select>

        <label for="image">Imaginea produsului:</label>
        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value=""><br><br>
    
        <button type="submit" name="adauga_produs">Adauga produsul</button>
    </form>
    </div>
</body>
</html>




<?php


if(isset($_POST["adauga_produs"])){
    $nume_produs=$_POST['nume_produs'];
	$pret=$_POST['pret'];
    $descriere=$_POST['descriere'];
    $id_categorie=$_POST['id_categorie'];
    $cantitate=$_POST['cantitate'];

    if((!empty($nume_produs)) && !(empty($pret)) && !(empty($descriere)) && !(empty($id_categorie)) && ($id_categorie!=0) && !(empty($cantitate)) && ($cantitate > 0)){

    $target_dir = "poze_produse/"; 
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    
if(isset($_POST["adauga_produs"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}


if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}


if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}


$allowed_extensions = array("jpg", "jpeg", "png");
if(!in_array($imageFileType, $allowed_extensions)) {
    echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
    $uploadOk = 0;
}


if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";

        
$image_path = $target_file; ;
$stmt = $conn->prepare("INSERT INTO produse (id_categorie, nume, pret, descriere, imagine, cantitate) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssi", $id_categorie, $nume_produs, $pret, $descriere, $image_path, $cantitate);
$stmt->execute();
$stmt->close();

header("Location: products.php");

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    
    
    }else{
        echo "Toate campurile trebuiesc completate";
    }

    
}
?>