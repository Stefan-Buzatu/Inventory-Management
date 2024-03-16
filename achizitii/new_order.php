<?php 
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");

	$utilizator_data = check_login($conn);
?>

<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index/logo.css">
    <title>Comanda noua</title>
    <style>
    .title-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-products-button {
            text-align: center;
            margin-top: 20px;
        }
        .list-group-item {
  display: flex;
  align-items: center; /* Aligns items vertically */
}

.quantity-text {
  margin: 0 10px; /* Adds spacing around the quantity */
}

.minus-btn svg {
  fill: red; /* Colors the minus button red */
}

.align-middle {
  vertical-align: middle; /* Aligns SVG vertically with the text */
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
    <h1>Coamnda noua</h1>
</div>




<br>

<div class="container">
    <div class="row">

<?php 
$sql = "SELECT * FROM cos_achizitii";
$result = mysqli_query($conn, $sql);

$totalSum = 0;
?>

<?php
    
    while ($row = mysqli_fetch_assoc($result)) {
      $totalSum = $totalSum + ($row['pret'] * $row['cantitate']);
    ?>
    <div class="col-md-4">
        <div class="card" style="width: 18rem;">
            <img src="<?php echo $row['imagine']; ?>" class="card-img-top" alt="<?php echo $row['nume']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['nume']; ?></h5>
                <p class="card-text"><?php echo $row['descriere']; ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?php echo $row['pret']; ?> RON</li>
                <li class="list-group-item">Numar de bucati:&nbsp&nbsp

                <a href="../produse/decrease_quantity.php?id_produs=<?php echo $row['id_produs']; ?>" class="minus-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle align-middle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                </svg>
                </a>
              
                <span class="quantity-text"><?php echo $row['cantitate']; ?></span>

                <a href="../produse/add_quantity.php?id_produs=<?php echo $row['id_produs']; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle align-middle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                </a>
                </li>
                <li class="list-group-item">Comanda data de: <?php echo $row['email_angajat']; ?></li>
            </ul>
            <div class="card-body">
                <a href="../produse/delete_product_from_order.php?id=<?php echo $row['id_produs']; ?>">
                    <button class="btn btn-danger">Delete</button>
                </a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    </div>
  </div>


  <div class="title-container">
    <h4>Suma totala de plata: <?php echo $totalSum; ?> RON</h4>
  </div>

  <?php 
  $_SESSION['totalSum'] = $totalSum;
  ?>

  <div class="add-products-button">
    <a href="finish_order.php" class="btn btn-primary">Finalizare comanda</a>
  </div>


    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>