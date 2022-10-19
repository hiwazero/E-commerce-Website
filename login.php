<?php 
    // include("model.php");
    
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
        include("header.php");
    ?>
</header>
<body>
    <div class="input-login">

            <div class="login-container">
                <div class="image-content">
                    <img src="content.jpeg" alt="">   
                </div>

                <div class="login-form">
                    <?php
                        if(isset($_SESSION["username"])) //CLEAR HEADER SESSION
                        {
                            session_destroy();
                            header("location: login.php");
                        }

                        if(isset($_SESSION["error_message"]))
                        {
                            foreach($_SESSION["error_message"] as $error)
                            { ?>
                                <p class="error"><?php echo $error."<br>"; ?></p>    
                      <?php }
                        }
                    ?>


                    <form action="process.php" method="POST">
                        <label for="">Username: </label>
                        <input type="text" name="username" required><br>
                        <label for="">Password: </label>
                        <input type="password" name="passcode" required><br>
                        <select name="user_type">
                            <option value="1">Admin</option>
                            <option value="2">Customer</option>
                        </select><br>
                        <input type="submit" name="login" value="Login">
                    </form>
                </div>
            </div>
            

          
    </div>
</body>
</html>