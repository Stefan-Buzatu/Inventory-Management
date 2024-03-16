<?php 
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");

	$utilizator_data = check_login($conn);
  if(isset($_SESSION['totalSum'])) {
    $totalSum = $_SESSION['totalSum'];
  } else {
    $totalSum = 0; // Default value in case it's not set
  }
?>

<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index/logo.css">





    <title>Furnizori</title>
  <style>

        .title-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-products-button {
            text-align: center;
            margin-top: 20px;
        }

        /* Container styles */
      .select-container {
    display: flex;
    justify-content: center;
    margin-top: 20px; /* Adjust this value as needed */
}

/* Select box styles */
.beautiful-select {
    width: 30%; /* Adjust the width as needed to make it less wide */
    padding: 10px 15px; /* Adds some padding inside the select box */
    border-radius: 5px; /* Rounds the corners of the select box */
    border: 1px solid #ced4da; /* Adds a light border to the select box */
    font-size: 16px; /* Adjust the font size as desired */
    color: #495057; /* Sets the text color */
    background-color: #fff; /* Sets the background color */
    outline: none; /* Removes the outline to make it look better on focus */
    box-shadow: 0 3px 5px 0 rgba(0,0,0,0.1); /* Adds a subtle shadow for depth */
    transition: all 0.3s ease; /* Smooth transition for hover effects */
}

.beautiful-select:hover,
.beautiful-select:focus {
    border-color: #80bdff; /* Changes the border color on hover/focus */
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25); /* Adds a glow effect on focus/hover */
}
        
  </style>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <img src="../poze_site/box.png" alt="Logo">  
    Inventory Management
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <!-- Left-aligned menu items -->
      <li class="nav-item active">
        <a class="nav-link" href="../index/index.php">Acasa<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../utilizatori/user_management.php">Administrarea utilizatorilor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../categorii/categories.php">Categorii</a>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Produse
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="../produse/products.php">Toate Produsele</a>
          <a class="dropdown-item" href="../produse/products_on_sale.php">Produsele la vanzare</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../clienti/sales.php">Vanzari</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Furnizori
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="providers.php">Lista furnizori</a>
          <a class="dropdown-item" href="new_order.php">Comanda noua</a>
          <a class="dropdown-item" href="order_history.php">Istoric comenzi</a>
        </div>
      </li>
    </ul>
    <div class="d-flex">
    <a href="../index/index.php" class="d-flex align-items-center">
      <img src="../poze_site/user.png" alt="Your Image" class="mr-2" style="height: 30px; width: auto;">
	  <p style="margin-bottom: 5px; color: white;">Salut <?php echo $utilizator_data['nume_utilizator'];?> &nbsp &nbsp</p>
    </a>
	
	<a href="../index/logout.php">
      <button class="btn btn-outline-light">Logout</button>
	</a>
    </div>
  </div>
</nav>

<div class="title-container">
    <h1>Alege furnizorul de la care vrei sa comanzi produsele</h1>
</div>






<div class="select-container">
<select class="form-select beautiful-select" aria-label="Default select example" name="id_furnizor" id="id_furnizor">
    <option value="0" selected>Alege furnizorul</option>
        <?php
        $query = "SELECT id_furnizor, nume FROM furnizori";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['id_furnizor']}'>{$row['nume']}</option>";
            }
        }
        ?>
    </select>
</div>

<div class="add-products-button">
    <a href="add_provider_order_page.php" class="btn btn-primary">Adauga alt furnizor</a>
</div>

<div class="title-container">
    <h4>Suma totala de plata: <?php echo $totalSum; ?> RON</h4>
  </div>


<div class="add-products-button">
    <button class="btn btn-success" id="redirectButton" onclick="myFunc()">Trimite comanda</button>
</div>

<div id="alertDiv" style="display: none; color: red; text-align: center; margin-top: 20px;">
  
</div>

<script>
  function myFunc() { 
    var selectedValue = document.getElementById('id_furnizor').value;
    if(selectedValue == "0") {
        // Show a div with an alert message instead of using alert();
        // Assuming there's a div with the id 'alertDiv' for showing the message
        var alertDiv = document.getElementById('alertDiv');
        alertDiv.innerHTML = 'Trebuie sa selectati un furnizor pentru a putea termina comanda!';
        alertDiv.style.display = 'block'; // Make sure the div is visible
    } else {
        // Proceed with redirection if a valid selection is made
        window.location.href = "process_order.php?id_furnizor=" + selectedValue + "&valoare=<?php echo $totalSum; ?>";
    }
  }
</script>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>