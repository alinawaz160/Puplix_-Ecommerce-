<?php
require("../admin/connection.inc.php");
require("user_authenticate.inc.php");
require("../admin/functions.inc.php");
$user_id = get_user_from_session($con)['id'];
$name = get_user_from_session($con)['name'];
$image = get_user_from_session($con)['image'];
$email = get_user_from_session($con)['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Puplix</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      .overlay {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: rgba(0, 0, 0, 0.5);
      }

      .modal {
         display: none;
         position: fixed;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         padding: 20px;
         background: #fff;
         border: 1px solid #ccc;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
         z-index: 1000;
      }
   </style>
</head>

<body>

   <header class="header">

      <section class="flex">

         <a href="index.php" class="logo"></a>
         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
         </div>

         <div class="profile">
            <?php
            if ($image != '') {
               echo "<img src='../media/profile/" . $image . "' class='image' alt='' />";
            } else {
               echo "<img src='https://tse4.mm.bing.net/th?id=OIP.tvaMwK3QuFxhTYg4PSNNVAHaHa&pid=Api&P=0&h=220' class='image' alt='' />";
            }
            ?>
            <h3 class="name">
               <?php echo $name ?>
            </h3>
            <p class="role">
               <?php echo $email ?>
            </p>
            <div class="flex-btn">
               <a href="/puplix/" class="option-btn">Home Screen</a>
               <a href="logout.php" class="delete-btn">Logout</a>
            </div>
         </div>

      </section>

   </header>

   <div class="side-bar">

      <div id="close-btn">
         <i class="fas fa-times"></i>
      </div>

      <div class="profile">
         <?php
         if ($image != '') {
            echo "<img src='../media/profile/" . $image . "' class='image' alt='' />";
         } else {
            echo "<img src='https://tse4.mm.bing.net/th?id=OIP.tvaMwK3QuFxhTYg4PSNNVAHaHa&pid=Api&P=0&h=220' class='image' alt='' />";
         }
         ?>
         <h3 class="name">
            <?php echo $name ?>
         </h3>
         <p class="role">
            <?php echo $email ?>
         </p>
      </div>

      <nav class="navbar">
         <a href="index.php"><i class="fas fa-home"></i><span>Dashboard</span></a>
         <a href="order.php"><i class='fas fa-border-all'></i><span>My Orders</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>My Cart</span></a>
         <a href="update.php"><i class="fas fa-chalkboard-user"></i><span>Manage Account </span></a>
         <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
      </nav>

   </div>