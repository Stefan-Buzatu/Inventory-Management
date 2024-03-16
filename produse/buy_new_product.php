<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");

$utilizator_data = check_login($conn);


if (isset($_GET['id_produs']) && isset($_GET['email_angajat'])) {
    $id = $_GET['id_produs'];
    $email = $_GET['email_angajat'];

    $queryDuplicate = "SELECT * FROM cos_achizitii WHERE id_produs = '$id'";
    $resultDuplicate = mysqli_query($conn, $queryDuplicate);

    if($resultDuplicate->num_rows > 0){

        header("Location: products.php");

    }
    else{
        $query = "SELECT * FROM produse WHERE id_produs = '$id'";
        $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        {
            $id_produs=$product['id_produs'];
            $id_categorie=$product['id_categorie'];
            $nume=$product['nume'];
            $pret=$product['pret'];
            $descriere=$product['descriere'];
            $imagine = "../produse/" . $product['imagine'];
            $cantitate=$product['cantitate'];
            
            $updateQuery = "INSERT INTO cos_achizitii (id_produs,id_categorie,nume,pret,descriere,imagine,email_angajat) VALUES ('$id_produs','$id_categorie','$nume','$pret','$descriere','$imagine','$email')";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                header("Location: ../achizitii/new_order.php");
            } else {
                echo "Eroare adaugare la camanda: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Produs negasit!";
    }
    }
    
    
} else {
    echo "Produs invalid!";
}
?>