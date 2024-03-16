<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");

$utilizator_data = check_login($conn);

if (isset($_GET['id_furnizor']) && isset($_GET['valoare'])) {
    $id_furnizor = $_GET['id_furnizor'];
    $valoare = $_GET['valoare'];
    $myuuid = guidv4();

    // Insert into 'achizitii' table
    $insertOrderResult = insertIntoAchizitii($conn, $myuuid, $id_furnizor, $utilizator_data['email'], $valoare);

    if ($insertOrderResult) {
        // Insert into 'produse_achizitii' table
        $insertProductsResult = insertIntoProduseAchizitii($conn, $myuuid);

    $deleteQuery = "DELETE FROM cos_achizitii";
    $deleteResult = mysqli_query($conn, $deleteQuery);


    $updateProducts = "UPDATE produse SET cantitate = cantitate +  WHERE id_produs=";

    if ($deleteResult) {
        header("Location: order_successful.php");
    } else {
        echo "Error deleting cos_achizitii: " . mysqli_error($conn);
    }

        

        if (!$insertProductsResult) {
            echo "Error executing the produse_achizitii query: " . mysqli_error($conn);
        }
    } else {
        echo "Error executing the achizitii query: " . mysqli_error($conn);
    }
}

// functie de generare a unui uuid
function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

// Function to insert into 'achizitii' table using prepared statement
function insertIntoAchizitii($conn, $myuuid, $id_furnizor, $email, $valoare) {
    $stmt = $conn->prepare("INSERT INTO achizitii (id_achizitie, id_furnizor, email_angajat, valoare) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $myuuid, $id_furnizor, $email, $valoare);
    return $stmt->execute();
}

// Function to insert into 'produse_achizitii' table using prepared statement and updates the quantity of produse and produse_la vanzare tables
function insertIntoProduseAchizitii($conn, $myuuid) {
    $getProductsQuery = "SELECT id_produs, id_categorie, cantitate FROM cos_achizitii";
    $getProductsResult = mysqli_query($conn, $getProductsQuery);

    if (!$getProductsResult) {
        return false; // Return false on query failure
    }

    $stmt = $conn->prepare("INSERT INTO produse_achizitii (id_achizitie, id_produs, id_categorie, cantitate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $myuuid, $id_produs, $id_categorie, $cantitate);

    $stmt1 = $conn->prepare("UPDATE produse SET cantitate = cantitate + ? WHERE id_produs = ? AND id_categorie = ?");
    $stmt1->bind_param("iii", $cantitate, $id_produs, $id_categorie);

    $stmt2 = $conn->prepare("UPDATE produse_la_vanzare SET cantitate = cantitate + ? WHERE id_produs = ? AND id_categorie = ?");
    $stmt2->bind_param("iii", $cantitate, $id_produs, $id_categorie);

    while ($row = mysqli_fetch_assoc($getProductsResult)) {
        $id_produs = $row['id_produs'];
        $id_categorie = $row['id_categorie'];
        $cantitate = $row['cantitate'];

        $stmt->execute();
        $stmt1->execute();
        $stmt2->execute();
    }

    mysqli_free_result($getProductsResult);
    $stmt->close();
    $stmt1->close();
    $stmt2->close();

    return true; // Return true on successful execution
}

?>
