<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<header>
    <?php
        include('header.php');
    ?> 
</header>
<body>

    <?php
        if(isset($_SESSION['error_register']))
        {
            foreach($_SESSION['error_register'] as $error)
            {
                echo $error."<br>";
            }
        }
    ?>

    <div class="register-container">
        <div class="image-content">
            <img src="content2.jpeg" alt="">   
        </div>

        <div class="register-form">
            <form action="process.php" method="POST">
                <div class="box">
                    <label for="">Username: </label>
                    <input type="text" name="username" required>
                </div>
                <div class="box">
                    <label for="">Password: </label>
                    <input type="password" name="passcode" required>
                </div>

                <div class="box">
                    <label for="">First Name: </label>
                    <input type="text" name="first_name" required>
                </div>

                <div class="box">
                    <label for="">Middle Name: </label>
                    <input type="text" name="middle_name" required>
                </div>

                <div class="box">
                    <label for="">Last Name: </label>
                    <input type="text" name="last_name" required>
                </div>

                <div class="box">
                    <label for="">Address: </label>
                    <input type="text" name="home_address" required>
                </div>

                <div class="box">
                    <label for="">Phone: </label>
                    <input type="text" name="phone_number" required>
                </div>

                <div class="box">
                    <label for="">E-mail: </label>
                    <input type="text" name="email" required>
                </div>

                <div class="box">
                    <select name="user_type" id="register">
                            <option value="1">Admin</option>
                            <option value="2">Customer</option>
                    </select>
                </div>

                <div class="box">
                    <input type="submit" name="register" value="Register" id="register">
                </div>

            </form>
        </div>
    </div>
</body>
</html>