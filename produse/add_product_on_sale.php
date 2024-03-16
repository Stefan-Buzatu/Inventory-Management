<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $queryDuplicate = "SELECT * FROM produse_la_vanzare WHERE id_produs = '$id'";
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
            $imagine=$product['imagine'];
            $cantitate=$product['cantitate'];
            
            $updateQuery = "INSERT INTO produse_la_vanzare (id_produs,id_categorie,nume,pret,descriere,imagine,cantitate) VALUES ('$id_produs','$id_categorie','$nume','$pret','$descriere','$imagine','$cantitate')";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                header("Location: products_on_sale.php");
            } else {
                echo "Eroare adaugare la vanzare: " . mysqli_error($conn);
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