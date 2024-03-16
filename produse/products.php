<?php
session_start();

include("../baza_de_date/db_connection.php");
include("../index/functii.php");

$utilizator_data = check_login($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index/logo.css">
    <title>Produse</title>
    <style>
        

        .navbar-brand img {
            height: 30px;
            width: auto;
            margin-right: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            color: white;
        }

        .user-info img {
            height: 30px;
            width: auto;
            margin-right: 5px;
        }

        .title-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-products-button {
            text-align: center;
            margin-top: 20px;
        }

        .filter-card {
            width: 50%; /* Adjust width as needed */
            margin: 0 auto; /* Center the filter card */
        }

        .card-deck .card {
        margin-right: 20px; /* Adjust the value as needed */
    }

    .card-deck .card-body {
        margin-bottom: 0; /* Reset the bottom margin for card-body */
    }

    .card-deck .card-footer {
        padding-top: 0; /* Reset the top padding for card-footer */
    }

    .row .card {
        margin-right: 20px; /* Adjust the value as needed */
    }

    .row .card-body {
        margin-bottom: 0; /* Reset the bottom margin for card-body */
    }

    .row .card-footer {
        padding-top: 0; /* Reset the top padding for card-footer */
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
          <a class="dropdown-item" href="products.php">Toate Produsele</a>
          <a class="dropdown-item" href="products_on_sale.php">Produsele la vanzare</a>
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
        <h1>Toate Produsele</h1>
    </div>

    <div class="add-products-button">
        <a href="add_product.php" class="btn btn-primary">Adaugare Produse</a>
    </div>

    <br>

    <form action="" method="GET">
        <div class="card shadow mt-3 filter-card">
            <div class="card-header">
                <h5>Filtru
                    <button type="submit" class="btn btn-primary btn-sm float-end">Aplica filtre</button>
                </h5>
            </div>
            <div class="card-body">
                <h6>Categorii</h6>
                <hr>
                <?php
                 $brand_query = "SELECT * FROM categorii";
                 $brand_query_run  = mysqli_query($conn, $brand_query);

                 if(mysqli_num_rows($brand_query_run) > 0)
                 {
                     foreach($brand_query_run as $brandlist)
                     {
                         $checked = [];
                         if(isset($_GET['brands']))
                         {
                             $checked = $_GET['brands'];
                         }
                         ?>
                             <div>
                                 <input type="checkbox" name="brands[]" value="<?= $brandlist['id_categorie']; ?>" 
                                     <?php if(in_array($brandlist['id_categorie'], $checked)){ echo "checked"; } ?>
                                  />
                                 <?= $brandlist['nume']; ?>
                             </div>
                         <?php
                     }
                 }
                 else
                 {
                     echo "No Brands Found";
                 }
                ?>
            </div>
        </div>
    </form>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-9">
                <div class="card-deck">
                    <div class="card-body row">
                        <?php
                        if(isset($_GET['brands']))
                        {
                            $branchecked = [];
                            $branchecked = $_GET['brands'];
                            foreach($branchecked as $rowbrand)
                            {
                                // echo $rowbrand;
                                $products = "SELECT * FROM produse WHERE id_categorie IN ($rowbrand)";
                                $products_run = mysqli_query($conn, $products);
                                if(mysqli_num_rows($products_run) > 0)
                                {
                                    foreach($products_run as $proditems) :
                                        ?>
                                            <div class="col-md-4">
                                            <div class="card" style="width: 18rem;">
                                            <img src="<?php echo $proditems['imagine']; ?>" class="card-img-top" alt="<?php echo $proditems['nume']; ?>">
                                            <div class="card-body">
                                            <h5 class="card-title"><?php echo $proditems['nume']; ?></h5>
                                            <p class="card-text"><?php echo $proditems['descriere']; ?></p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><?php echo $proditems['pret']; ?> RON</li>
                                            <li class="list-group-item">Numar de bucati: <?php echo $proditems['cantitate']; ?></li>
                                            </ul>
                                            <div class="card-body">
                                            <a href="add_product_on_sale.php?id=<?php echo $proditems['id_produs']; ?>">
                                            <button class="btn btn-success">Pune la vanzare</button>
                                            </a>
                                            <a href="edit_product.php?id=<?php echo $proditems['id_produs']; ?>">
                                            <button class="btn btn-info">Editeaza</button>
                                            </a>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                            <a href="buy_new_product.php?id_produs=<?php echo $proditems['id_produs']; ?>&email_angajat=<?php echo $utilizator_data['email']; ?>">
                                            <button class="btn btn-primary">Adauga la comanda</button>
                                            </a>
                                            </li>
                                            </ul>
                                            </div>
                                            </div>
                                        <?php
                                    endforeach;
                                }
                            }
                        }
                        else
                        {
                            $products = "SELECT * FROM produse";
                            $products_run = mysqli_query($conn, $products);
                            if(mysqli_num_rows($products_run) > 0)
                            {
                                foreach($products_run as $proditems) :
                                    ?>
                                            <div class="col-md-4">
                                            <div class="card" style="width: 18rem;">
                                            <img src="<?php echo $proditems['imagine']; ?>" class="card-img-top" alt="<?php echo $proditems['nume']; ?>">
                                            <div class="card-body">
                                            <h5 class="card-title"><?php echo $proditems['nume']; ?></h5>
                                            <p class="card-text"><?php echo $proditems['descriere']; ?></p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><?php echo $proditems['pret']; ?> RON</li>
                                            <li class="list-group-item">Numar de bucati: <?php echo $proditems['cantitate']; ?></li>
                                            </ul>
                                            <div class="card-body">
                                            <a href="add_product_on_sale.php?id=<?php echo $proditems['id_produs']; ?>">
                                            <button class="btn btn-success">Pune la vanzare</button>
                                            </a>
                                            <a href="edit_product.php?id=<?php echo $proditems['id_produs']; ?>">
                                            <button class="btn btn-info">Editeaza</button>
                                            </a>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                            <a href="buy_new_product.php?id_produs=<?php echo $proditems['id_produs']; ?>&email_angajat=<?php echo $utilizator_data['email']; ?>">
                                            <button class="btn btn-primary">Adauga la comanda</button>
                                            </a>
                                            </li>
                                            </ul>
                                            </div>
                                            </div>
                                    <?php
                                endforeach;
                            }
                            else
                            {
                                echo "No Items Found";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>