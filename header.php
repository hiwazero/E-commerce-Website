<?php 
include('model.php');
$product = new MODEL();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> -->
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<header>
    <div class="heading">
        <div class="store">
            <div class="store-logo">
                <img src="logo2.png" alt="Ryan Store">
            </div>
            <div class="store-name">
                <a href="landing.php"><h2>Ryan Store</h2></a>
            </div>
            <?php 
                if(isset($_SESSION['username']) && $_SESSION['user_type'] == 2) //FOR USERS 
                { ?>
                    <!-- <h2>Welcome  -->
                        <?php 
                        // echo $_SESSION['username'];
                        ?>
                    <!-- </h2> -->
         <?php  }
                else if(isset($_SESSION['username']) && $_SESSION['user_type'] == 1) //FOR ADMINS
                { ?>
                     <!-- <h2>Welcome Admin  -->
                        <?php 
                        // echo $_SESSION['username'];
                        ?>
                    <!-- </h2> -->
          <?php }
            ?>
        </div>
        <!---------------- -------->
        <nav class="navigation">
            <?php
            if(isset($_SESSION['username']) && $_SESSION['user_type']==2)
              { ?>
                <div class="shop-btn"> <!-- FOR USERS -->  
                    <h3 id="default"><a href="user_product.php?category_id=1.php">Shop</a></h3>
                    <h3 id="icon"><a href="user_product.php?category_id=1.php"><span class="material-symbols-outlined">storefront</span></a></h3>   
                </div>
                <div class="cart-btn">
                    <h3 id="default"><a href="cart.php">View Cart</a></h3>
                    <h3 id="icon"><a href="cart.php"><span class="material-symbols-outlined">shopping_cart</span></a></h3>
                </div>
                <div class="orders-btn">
                    <h3 id="default"><a href="user_order.php">Orders</a></h3>
                    <h3 id="icon"><a href="user_order.php"><span class="material-symbols-outlined">list_alt</span></a></h3>
                </div>
                <div class="logout-btn">
                    <h3 id="default"><a href="logout.php">Logout</a></h3>
                    <h3 id="icon"><a href="logout.php"><span class="material-symbols-outlined">logout</span></a></h3>
                </div>
        <?php } 
            else if(isset($_SESSION['username']) && $_SESSION['user_type']==1)
            { ?>
             <!-- FOR ADMIN -->
             <div class="addProduct-btn">
                <!-- <h3 id="default"><a href=""></a></h3>
                <h3 id="icon"><a href=""></a></h3> -->
                <h3 id="default"><a href="index.php">Add Product</a></h3>
                <h3 id="icon"><a href="index.php"><span class="material-symbols-outlined">add_circle</span></a></h3>
             </div>
            <div class="viewProduct-btn">
                <h3 id="default"><a href="admin_product.php?category_id=1">View Product</a></h3>
                <h3 id="icon"><a href="admin_product.php?category_id=1"><span class="material-symbols-outlined">view_list</span></a></h3>
            </div>
            <div class="logout-btn">
                <h3 id="default"><a href="logout.php">Logout</a></h3>
                <h3 id="icon"><a href="logout.php"><span class="material-symbols-outlined">logout</span></a></h3>
            </div>

       <?php } 
            else
            { ?>
            <div class="shop-btn"> <!-- NOT LOG IN --->
                <h3 id="default"><a href="user_product.php?category_id=1.php">Shop</a></h3>
                <h3 id="icon"><a href="user_product.php?category_id=1.php"><span class="material-symbols-outlined">storefront</span></a></h3>         
            </div>
            <div class="login-btn">
                <h3 id="default"><a href="login.php">Login</a></h3>
                <h3 id="icon"><a href="login.php"><span class="material-symbols-outlined">login</span></a></h3>      
            </div>
            <div class="register-btn">
                <h3 id="default"><a href="registration.php">Sign Up</a></h3>
                <h3 id="icon"><a href="registration.php"><span class="material-symbols-outlined">app_registration</span></a></h3>  
            </div>
      <?php }
       ?>
        </nav>
    </div>
</header>
</html>