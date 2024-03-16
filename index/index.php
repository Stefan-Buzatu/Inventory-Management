<?php 
session_start();

include("../baza_de_date/db_connection.php");
include("functii.php");

	$utilizator_data = check_login($conn);
?>
	
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="logo.css">
    <title>Acasa</title>

    <style>
  body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #343a40;
    }

    .navbar {
      background-color: #343a40;
    }

    .navbar-brand img {
      height: 30px;
      width: auto;
      margin-right: 10px;
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: #ffffff;
    }

    .navbar-toggler-icon {
      background-color: #ffffff;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 80vh;
    }

    .row {
      text-align: center;
    }

    .col-xs-3,
    .col-md-2 {
      width: 200px;
      margin: 10px;
      padding: 15px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .col-xs-3 img,
    .col-xs-3 img {
      max-width: 100%;
      height: auto;
    }

    .btn-outline-light {
      color: #ffffff;
      border-color: #ffffff;
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
        <a class="nav-link" href="index.php">Acasa<span class="sr-only">(current)</span></a>
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
          <a class="dropdown-item" href="../achizitii/providers.php">Lista furnizori</a>
          <a class="dropdown-item" href="../achizitii/new_order.php">Comanda noua</a>
          <a class="dropdown-item" href="../achizitii/order_history.php">Istoric comenzi</a>
        </div>
      </li>
    </ul>
    <div class="d-flex">
    <a href="index.php" class="d-flex align-items-center">
      <img src="../poze_site/user.png" alt="Your Image" class="mr-2" style="height: 30px; width: auto;">
	  <p style="margin-bottom: 5px; color: white;">Salut <?php echo $utilizator_data['nume_utilizator'];?> &nbsp &nbsp</p>
    </a>
	
	<a href="logout.php">
      <button class="btn btn-outline-light">Logout</button>
	</a>
    </div>
  </div>
</nav>

    <?php
    $sql = "SELECT COUNT(*) as user_count FROM utilizatori";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $userCount = $row['user_count'];

    $sql2 = "SELECT COUNT(*) as category_count FROM categorii";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $categoryCount = $row2['category_count'];

    $sql3 = "SELECT COUNT(*) as product_count FROM produse";
    $result3 = $conn->query($sql3);
    $row3 = $result3->fetch_assoc();
    $productCount = $row3['product_count'];

    $sql4 = "SELECT SUM(valoare) as total_amount FROM comenzi";
    $result4 = $conn->query($sql4);
    $row4 = $result4->fetch_assoc();
    $salesCount = $row4['total_amount'];
    ?>

<div class="container">
  <div class="row">
  
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card">
        <a href="../utilizatori/user_management.php" style="color:black;">
        <img class="card-img-top" src="../poze_site/users.png" alt="Users">
        <div class="card-body">
          <h5 class="card-title"><?php echo $userCount; ?></h5>
          <p class="card-text">Utilizatori</p>
        </div>
      </div></a>
    </div>
  
  
    <div class="col-6 col-md-4 col-lg-3">
      <a href="../categorii/categories.php" style="color:black;">
      <div class="card">
        <img class="card-img-top" src="../poze_site/categories.png" alt="Categories">
        <div class="card-body">
          <h5 class="card-title"><?php echo $categoryCount; ?></h5>
          <p class="card-text">Categorii</p>
        </div>
      </div></a>
    </div>
    
    
    
    <div class="col-6 col-md-4 col-lg-3">
      <a href="../produse/products.php" style="color:black;">
      <div class="card">
        <img class="card-img-top" src="../poze_site/products.png" alt="Products">
        <div class="card-body">
          <h5 class="card-title"><?php echo $productCount; ?></h5>
          <p class="card-text">Produse</p>
        </div>
      </div></a>
    </div>
    
    
    <div class="col-6 col-md-4 col-lg-3">
      <a href="../clienti/sales.php" style="color:black;">
      <div class="card">
        <img class="card-img-top" src="../poze_site/sales.png" alt="Sales">
        <div class="card-body">
          <h5 class="card-title"><?php echo $salesCount; ?> RON</h5>
          <p class="card-text">Vanzari</p>
        </div>
      </div> </a>
    </div>
   
  </div>
</div>






    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>