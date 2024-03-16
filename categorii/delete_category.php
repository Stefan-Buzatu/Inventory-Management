

<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");

if (isset($_GET['id_categorie'])) {
    $id_categorie = $_GET['id_categorie'];

    $setQuery1 = "UPDATE produse SET id_categorie = 0 WHERE id_categorie = '$id_categorie'";
    $setResult1 = mysqli_query($conn, $setQuery1);

    $setQuery2 = "UPDATE produse_la_vanzare SET id_categorie = 0 WHERE id_categorie = '$id_categorie'";
    $setResult2 = mysqli_query($conn, $setQuery2);

    $deleteQuery = "DELETE FROM categorii WHERE id_categorie = '$id_categorie'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult && $setResult1 && $setResult2) {
        header("Location: categories.php");
    } else {
        echo "Eroare la stergere: " . mysqli_error($conn);
    }
} else {
    echo "Categoria nu a fost gasita";
}
?>

