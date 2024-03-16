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
    <title>Vanzari</title>
  <style>
       
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
        <a class="nav-link" href="sales.php">Vanzari</a>
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
    <h1 style="text-align:center">Tabel Clienti</h1>
</div>

<div class="container custom-table-container">
  <table class="table table-striped table-dark custom-table">
  <thead>
        <tr>
            <th>CNP</th>
            <th>Nume</th>
            <th>Oras</th>
            <th>Numar de telefon</th>
            <th>Data inregistrarii</th>
            <th style="text-align:center">Actiuni</th>
        </tr>
</thead>
<tbody>
        <?php
$query="SELECT * FROM clienti";
$result = mysqli_query($conn,$query);?>

<?php if ($result->num_rows > 0): ?>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row["cnp"]; ?></td>
      <td><?php echo $row["nume"]; ?></td>
      <td><?php echo $row["oras"]; ?></td>
      <td><?php echo $row["tel"]; ?></td>
      <td><?php echo $row["data_inreg"]; ?></td>
      <td style="text-align:center">
      <a href="edit_client.php?cnp=<?php echo $row['cnp'];?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#99ff66" class="bi bi-pencil-square" viewBox="0 0 16 16">
      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
      </svg>
      </a>&nbsp&nbsp
      <a href="show_client_orders.php?cnp=<?php echo $row['cnp'];?>">
          <button class="btn btn-info">Afisare Comenzi</button></a>
      </td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr>
    <td style="text-align:center" colspan="6">0 results</td>
  </tr>
<?php endif; ?>
</tbody>
</table>
</div>


<div class="title-container">
    <h1 style="text-align:center">Tabel Comenzi</h1>
</div>

<div class="container custom-table-container">
  <table class="table table-striped table-dark custom-table">
  <thead>
        <tr>
            <th>ID Comanda</th>
            <th>CNP</th>
            <th>Valoare(RON)</th>
            <th>Data Comenzii</th>
            <th style="text-align:center">Actiuni</th>
        </tr>
</thead>
<tbody>
        <?php
$query="SELECT * FROM comenzi";
$result = mysqli_query($conn,$query);?>

<?php if ($result->num_rows > 0): ?>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row["id_comanda"]; ?></td>
      <td><?php echo $row["cnp"]; ?></td>
      <td><?php echo $row["valoare"]; ?></td>
      <td><?php echo $row["data"]; ?></td>
      <td style="text-align:center">
      <a href="show_order_details.php?id_comanda=<?php echo $row['id_comanda'];?>">
          <button class="btn btn-primary">Detalii Comanda</button></a>
      </td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr>
    <td style="text-align:center" colspan="5">0 results</td>
  </tr>
<?php endif; ?>
</tbody>
</table>
</div>



    
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>