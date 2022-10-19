<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryan Store Shipping Form</title>
</head>
<header>
    <?php include("header.php"); ?>
</header>
<body>
    <?php 
        if(isset($_SESSION["error_order"]))
        {
            foreach($_SESSION["error_order"] as $error)
            {
                echo $error."<br>";   
            }
        }
        $username = $_SESSION['username'];
        $cart_id = $product->get_lastCart();
        $user = $product->get_user($_SESSION['username']);
        foreach($user as $u)
        {
            ?>
            <form action="process.php" method="POST">
                <input type="hidden" name="cart_id" value="<?php echo  $cart_id; ?>">
                <input type="hidden" name="username" value="<?php echo $username; ?>">
                <label for="">First Name: </label>
                <input type="text" name="first_name" value="<?php echo $u['first_name']; ?>" required><br>
                <label for="">Middle Name: </label>
                <input type="text" name="middle_name" value="<?php echo $u['middle_name']; ?>" ><br>
                <label for="">Last Name: </label>
                <input type="text" name="last_name"  value="<?php echo $u['last_name']; ?>" required><br>
                <label for="">Address: </label>
                <input type="text" name="home_address" value="<?php echo $u['home_address']; ?>" required><br>
                <label for="">Phone Number: </label>
                <input type="text" name="phone_number" value="<?php echo $u['phone_number']; ?>" required><br>
                <label for="">E-mail: </label>
                <input type="text" name="email" value="<?php echo $u['email']; ?>" required><br>
                <input type="submit" name="Order" value="Order">
            </form>
       <?php      
        }


    ?>
</body>
</html>