<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");


if (isset($_GET['id_categorie'])) {
    $id_categorie = $_GET['id_categorie'];

    
    $query = "SELECT * FROM categorii WHERE id_categorie = '$id_categorie'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $categorie = $result->fetch_assoc();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $newName = $_POST['newName'];

            $updateQuery = "UPDATE categorii SET nume = '$newName' WHERE id_categorie = '$id_categorie'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                header("Location: categories.php");
            } else {
                echo "Eroare editare nume categorie: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Categoria nu a fost gasita!";
    }
} else {
    echo "Categoria nu a fost gasita!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Edit Category</title>
</head>
<body>

    <div class="container mt-5">
        <h2>Editare Categorie</h2>
        <form method="POST">
            <div class="form-group">
                <label for="newName">Nume nou:</label>
                <input type="text" class="form-control" id="newName" name="newName" value="<?php echo $categorie['nume']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>