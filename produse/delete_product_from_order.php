<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $deleteQuery = "DELETE FROM cos_achizitii WHERE id_produs = '$id'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        header("Location: ../achizitii/new_order.php");
    } else {
        echo "Eroare stegere produs: " . mysqli_error($conn);
    }
} 
?>
