<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");

$utilizator_data = check_login($conn);


if (isset($_GET['email'])) {
    $email = $_GET['email'];

    
    $deleteQuery = "DELETE FROM utilizatori WHERE email = '$email'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        header("Location: user_management.php");
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
} else {
    echo "Email parameter not set!";
}
?>
