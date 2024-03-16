<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");

if (isset($_GET['cnp'])) {
    $cnp = $_GET['cnp'];

    
    $query = "SELECT * FROM clienti WHERE cnp = '$cnp'";
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        $client_data = $result->fetch_assoc();

        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $newName = $_POST['newName'];
            $newCity = $_POST['newCity'];
            $newPhoneNumber = $_POST['newPhoneNumber'];

            
            $updateQuery = "UPDATE clienti SET nume = '$newName', tel = '$newPhoneNumber', oras = '$newCity' WHERE cnp = '$cnp'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                header("Location: sales.php");
            } else {
                echo "Eroare editare client: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Clientul nu a fost gasit!";
    }
} else {
    echo "CNP invalid!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Editare Client</title>
</head>
<body>

    <div class="container mt-5">
        <h2>Editare Client</h2>
        <form method="POST">
            <div class="form-group">
                <label for="newName">Nume nou:</label>
                <input type="text" class="form-control" id="newName" name="newName" value="<?php echo $client_data['nume']; ?>" required>
            </div>
            <div class="form-group">
                <label for="newCity">Oras nou:</label>
                <input type="text" class="form-control" id="newCity" name="newCity" value="<?php echo $client_data['oras']; ?>" required>
            </div>
            <div class="form-group">
                <label for="newPhoneNumber">Numar nou:</label>
                <input type="text" class="form-control" id="newPhoneNumber" name="newPhoneNumber" value="<?php echo $client_data['tel']; ?>" required>
            </div>
            <button type="submit" class="btn btn-dark">Salveaza</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>