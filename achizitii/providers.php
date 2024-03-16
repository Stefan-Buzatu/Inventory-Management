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

        .custom-table-container {
      margin-top: 20px; /* Adjust the margin-top as needed */
      border-radius: 10px;
    }

    .custom-table {
      margin: 0 auto; /* This will center the table horizontally */
      width: 120%; /* Adjust the width as needed */
      border-spacing: 0;
      border-collapse: separate;
      border-radius: 10px;
      border: 1px solid black;
    }
    .custom-table thead th:first-child {
      border-top: none; /* Remove top border from the first th in the thead */
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
    <h1>Lista de furnizori</h1>
</div>

<div class="add-products-button">
    <a href="add_provider.php" class="btn btn-primary">Adaugare furnizor</a>
</div>

<br>
<br>

<div class="container custom-table-container">
  <table class="table table-striped table-dark custom-table">
  <thead>
        <tr>
            <th>Nume furnizorr</th>
            <th>Oras</th>
            <th>Numar de telefon</th>
            <th>Data inregistrarii</th>
            <th>IBAN</th>
            <th>Actiuni</th>
        </tr>
</thead>
<tbody>
        <?php
$query="SELECT * FROM furnizori";
$result = mysqli_query($conn,$query);?>

<?php if ($result->num_rows > 0): ?>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row["nume"]; ?></td>
      <td><?php echo $row["oras"]; ?></td>
      <td><?php echo $row["tel"]; ?></td>
      <td><?php echo $row["data_inreg"]; ?></td>
      <td><?php echo $row["iban"]; ?></td>
      <td><a href="edit_provider.php?id=<?php echo $row['id_furnizor'];?>">
          <button class="btn btn-primary">Edit</button>
        </a></td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr>
    <td colspan="6">0 results</td>
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