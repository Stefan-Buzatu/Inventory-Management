<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");


if (isset($_GET['id_produs'])) {
    $id = $_GET['id_produs'];

    $deleteQuery = "UPDATE cos_achizitii SET cantitate = cantitate + 1 WHERE id_produs = '$id';";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        header("Location: ../achizitii/new_order.php");
    } else {
        echo "Eroare adaugare cantitate: " . mysqli_error($conn);
    }
} 
?>
