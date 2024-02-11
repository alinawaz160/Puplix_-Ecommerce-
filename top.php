<?php
if (session_status() === PHP_SESSION_NONE) {
  require("admin/connection.inc.php");
}
require("admin/functions.inc.php");
$sql = "select * from categories where status=1 order by categories asc";
$res = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="Enter your description here" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://fontawesome.com/icons">

  <link href="img/favicon.ico" rel="icon">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap"
    rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <link href="css/style.css" rel="stylesheet">
  <title>PupLix</title>
  <style>
    .btn-pink {
      background-color: pink;
      border-color: pink;
      color: white;
      /* Set text color to white for better visibility */
    }
  </style>
</head>

<body>
  <div class="top-navbar">
    <p>WELCOME TO OUR STORE</p>
    <?php
    if (is_user_login() == false && is_admin_login() == false) {
      echo "
    <div class='icons'>
      <a href='register.php' class='l'><img src='./assets/images/register.png' alt='' width='18px'><label for='flip'>Login</label></a>
      <a href='/puplix/admin/login.php' class='l'><img src='./assets/images/register.png' alt='' width='18px'><label for='flip'>Login As Admin</label></a>
      <a href='register.php' class='l'><img src='./assets/images/register.png' alt='' width='18px'><label for='flip'>Sign Up</label></a>
    </div>";
    } else if (is_admin_login() == true) {
      echo "
      <div class='icons'>
      <a href='/puplix/admin/index.php' class='l'><label for='flip'>Move to Portal</label></a>
      </div>
      ";
    } else {
      echo "
      <div class='icons'>
      <a href='/puplix/user/index.php' class='l'><label for='flip'>Move to Portal</label></a>
      </div>
      ";

    }
    ?>
  </div>
  <nav class="navbar navbar-expand-lg" id="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php" id="logo"><i class="fas fa-paw"></i><span
          id="span1">P</span>up<span>L</span>ix<span></span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span><img src="./assets/images/menu.png" alt="" width="30px"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active " aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: rgb(67 0 86);">
              <li><a class="dropdown-item" href="boarding.php">Boarding</a></li>
              <li><a class="dropdown-item" href="grooming.php">Grooming</a></li>
              <li><a class="dropdown-item" href="feeding.php">Feedinge</a></li>
              <li><a class="dropdown-item" href="#">Execise</a></li>
              <li><a class="dropdown-item" href="#">Training</a></li>
              <li><a class="dropdown-item" href="#">Treatment</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
              style="background-color: rgb(67 0 86);z-index: 1;position:absolute">
              <?php
              $i = 0;
              while ($row = mysqli_fetch_assoc($res)):
                ?>
                <li>
                  <a class='dropdown-item' href='category_wise_product.php?categories_id=<?= $row['id'] ?>'>
                    <?= $row['categories'] ?>
                  </a>
                </li>
              <?php endwhile; ?>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
        <form class="d-flex" id="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>