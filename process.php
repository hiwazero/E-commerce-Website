<?php
    session_start();
    require('model.php');
    $product = new MODEL();

    //UPLOAD FILE FUNCTION
    function get_file() 
    {
        if(isset($_FILES['file1']))
        {
            $product_image = $_FILES['file1']['name']; //filename
            $source = $_FILES['file1']['tmp_name']; //put the image in temporary folder
            $path = getcwd().DIRECTORY_SEPARATOR.'images'; //directory path 
            $target = $path.DIRECTORY_SEPARATOR.$product_image; //directory path with file name
            move_uploaded_file($source,$target); // move file from temporary to permanent folder    
            return $product_image;
        }
    }
    
        // VALIDATE PASSWORD FUNCTION
    function validate_password($passcode)
    {
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[[:upper:]])[[:print:]]{8,}$/';
        return preg_match($pattern,$passcode);
    }

        //VALIDATE FULL NAME FUNCTION
    function validate_name($name)
    {
        $pattern = '/^[a-zA-Z]+$/';
        return preg_match($pattern,$name);
    }

        //VALIDATE HOME ADDRESS FUNCTION
    function validate_address($home_address) 
    {
        // $pattern = '/^[^\w\s]+$/';
        $pattern = '/^[\w\s]+$/';
        return preg_match($pattern,$home_address);
    }

        //VALIDATE PHONE NUMBER
    function validate_phone($phone_number)
    {
        $pattern = '/^[\d]+$/';
        return preg_match($pattern,$phone_number);
    }

    function validate_email($email)
    {
        $pattern = '/^\\S+@\\S+\\.\\S+$/';
        return preg_match($pattern,$email);
    }


    if(isset($_POST['add_product']))
    {
        $category_id = $_POST['category_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_description = $_POST['product_description'];
        $product->add_product($category_id,$product_name,$product_price,get_file(),$product_description);
        header('location: index.php');
    }

    if(isset($_GET['product_id']) && isset($_GET['option']) && isset($_GET['category_id']) && isset($_GET['product_image']))
    {
        $product_id = $_GET['product_id'];
        $option = $_GET['option'];
        $category_id = $_GET['category_id'];
        $product_image = $_GET['product_image'];

        switch($option)
        {
            case 1:
                header('location: admin_product.php?category_id='.$category_id.'&product_id='.$product_id.'&product_image='.$product_image);
                break;
            case 2:
                $product->delete_product($product_id);
                $target = getcwd().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$product_image;
                unlink($target);
                header('location: admin_product.php?category_id='.$category_id);
                break;
        }
    }

    if(isset($_POST['save']))
    {
        $new_image = $_FILES['file1']['name']; //new file
        $product_image = $_POST['product_image']; //old file
        $category_id = $_POST['category_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_id = $_POST['product_id'];
        $product_description = $_POST['product_description'];

        if(empty($new_image))
            $product->update_product($category_id,$product_name,$product_price,$product_id,$product_description);
        else
        {
            echo "false";
            $product->update_product2($category_id,$product_name,$product_price,$product_id,get_file(),$product_description); //new data in columns
            $target = getcwd().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$product_image; //directory of old image to be deleted
            unlink($target);//delete image function
        }
        header('location: admin_product.php?category_id='.$category_id);
    }

    if(isset($_POST['register']))
    {
        $usertype = 2;
        $username = trim($_POST['username']);
        $passcode = trim($_POST['passcode']);
        $first_name = trim($_POST['first_name']);
        $middle_name = trim($_POST['middle_name']);
        $last_name = trim($_POST['last_name']);
        $home_address = $_POST['home_address'];
        $phone_number = trim($_POST['phone_number']);
        $email = trim($_POST['email']);
        $usertype = trim($_POST['user_type']);
        $check = array();
        $error_register = array(); //CREATE ARRAY OF ERRORS
        $info_values = [
            $username,
            $passcode,
            $first_name,
            $middle_name,
            $last_name,
            $home_address,
            $email
        ];

        //CHECK IF USERNAME EXISTS IN DATABASE
        if($product->count_username($username)>0)
        {
            $error_register[] =  "Username Exists";
            $_SESSION['error_register'] = $error_register;
            header('location: registration.php');
        }
        else
        {
            $check[] = 1;
            $username;
        }
    
        //TEST PASSCODE
        if(validate_password($passcode) === 0)
        {
            $error_register[] = "Password must have minimum of 8 characters and contains Uppercase,Lowecase,special character"; 
            $_SESSION["error_register"] = $error_register;
            header("location: registration.php");
        }
        else
        {
            $check[] = 1;
            $passcode_sha1 = sha1($passcode);
        }

        // TEST FIRST , MIDDLE AND LAST NAME
        if(isset($first_name) && isset($last_name))
        {
            if(validate_name($first_name) === 0 || validate_name($last_name) === 0)
            {
                $error_register[] = "Name must contain letters only.";
                $_SESSION["error_register"] = $error_register;
                header("location: registration.php");
            }
            else
            {
                $check[] = 1;
                $first_name;
                $middle_name;
                $last_name;
            }
        }

        //CHECK HOME ADDRESS
        if(isset($home_address))
        {
            if(validate_address($home_address) === 0)
            {
                $error_register[] = "Address must contain letters and numbers only";
                $_SESSION["error_register"] = $error_register;
                header("location: registration.php");
            }
            else
            {
                $check[] = 1;
                $home_address;
            }
        }

        //CHECK PHONE NUMBER
        if(isset($phone_number))
        {
            if(validate_phone($phone_number) === 0)
            {
                $error_register[] = "Phone number must be digits only";
                $_SESSION["error_register"] = $error_register;
                header("location: registration.php");
            }
            else
            {
                $check[] = 1;
                $phone_number;
            }
        }

        //CHECK EMAIL
        if(isset($email))
        {
            if(validate_email($email) === 0)
            {
                $error_register[] = "Please input valid email";
                $_SESSION["error_register"] = $error_register;
                header("location: registration.php");
            }
            else
            {
                $check[] = 1;
                $email;
            }
        }
        
        //IF ALL INFOS ARE FILLED CORRECTLY ... REGISTER USER !
        if(count($check)==6)
        {
            $product->register_user($usertype,$username,$passcode_sha1,$first_name,$middle_name,$last_name,$home_address,$phone_number,$email);
            unset($error_register);
            $_SESSION['error_register'] = $error_register;
            header('location: login.php');
        }
        else
        {
            unset($error_register);
            $error_register[] = "Please fill up all required informations.";
            $_SESSION['error_register'] = $error_register;
            header('location: registration.php');
        }
    }

    if(isset($_POST['login']))
    {
        $username = trim($_POST['username']);
        $passcode = trim($_POST['passcode']);
        $user_type = $_POST['user_type'];
        $sha_passcode = sha1($passcode);
        $error_login = array();
    
        //FOR ADMIN ACCOUNTS
        if($product->validateLogin($username, $sha_passcode, $user_type) >= 1) 
        {
            if($user_type==1) //check usertype if admin
            {
                echo $_SESSION["username"] = $username;
                echo $_SESSION["user_type"] = $user_type;
                header("location: index.php");
            }
            else //check usertype if customer
            {
                echo $_SESSION["username"] = $username;
                echo $_SESSION["user_type"] = $user_type;
                header("location: user_product.php?category_id=1");
            }
        }

        else
        {
            if(empty($username))
                $error_login[] = "Please enter valid inputs";
            else
                $error_login[] = "Invalid Username or Password";

            $_SESSION["error_message"] = $error_login;
            header('location: login.php');
        }
    }

    if(isset($_GET['product_id']) && !isset($_GET['option']) && !isset($_GET['add_quantity']) && !isset($_REQUEST['product_quantity']))
    {
        $product_id = $_GET['product_id'];
        header('location: view_product.php?product_id='.$product_id);
    }

    if(isset($_POST['add-to-cart']))
    {
        $category_id = $_POST['category_id'];
        $username = $_POST['username'];
        $product_id = $_POST['product_id'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
        $sub_total = $product_price * $product_quantity;
        $product->check_cart($product_id);
        
        //CREATE CART_ID
        if($product->cart_user($username)>0)
            $cart_id = $product->get_lastCart();
        else
            $cart_id = $product->cart_user($username)+1;

        //ADD ITEM TO CART
        if($product->check_cart($product_id)<1) 
            $product->cart($cart_id,$product_id,$product_quantity,$sub_total,$username);
        else
        {
            $prev_qty = $product->get_quantity($product_id);
            $new_qty =   $prev_qty + $product_quantity;
            $product->update_quantity($product_id, $new_qty,$username);
        }
        header('location: user_product.php?category_id='.$category_id);
    }

    if(isset($_REQUEST['add_quantity']) && isset($_REQUEST['product_quantity']) && isset($_REQUEST['product_id']))
    {
        $product_id = $_REQUEST['product_id'];
        $product_quantity = $_REQUEST['product_quantity'];
        $add_quantity = $_REQUEST['add_quantity'];
        $new_qty =   $product_quantity + $add_quantity;
       
        $product->update_quantity($product_id, $new_qty,$_SESSION['username']);  
        header('location: cart.php');
    }

    if(isset($_REQUEST['subtract_quantity']) && isset($_REQUEST['product_quantity']) && isset($_REQUEST['product_id']))
    {
        $product_id = $_REQUEST['product_id'];
        $product_quantity = $_REQUEST['product_quantity'];
        $subtract_quantity = $_REQUEST['subtract_quantity'];
        $new_qty =  $product_quantity - $subtract_quantity;

        if($new_qty < 1)
            $product->delete_cart($product_id);
        else
            $product->update_quantity($product_id, $new_qty,$_SESSION['username']);
        header('location: cart.php');
    }

    if(isset($_POST['Order']))
    {
        $username = trim($_SESSION['username']);
        $first_name = trim($_POST['first_name']);
        $middle_name = $_POST['middle_name'];
        $last_name = trim($_POST['last_name']); // count 1
        $home_address = trim($_POST['home_address']); // count 1
        $phone_number = trim($_POST['phone_number']); // count 1
        $email = trim($_POST['email']); // count 1
        $cart_id = $_POST['cart_id'];
        $order_status = 0;
     
        $error_order = array();
        $check = array();

            //CHECK NAME 
            if(isset($first_name) && isset($last_name))
            {
                if(validate_name($first_name) === 0 && validate_name($last_name) === 0)
                {
                    $error_order[] = "Name must contain letters only.";
                    $_SESSION["error_order"] = $error_order;
                    header("location: order.php");
                }
                else
                {
                    $check[] = 1;
                    $first_name;
                    $middle_name;
                    $last_name;
                }
            }

            //CHECK ADDRESS
            if(isset($home_address))
            {
                if(validate_address($home_address) === 0)
                {
                    $error_order[] = "Address must contain letters and numbers only";
                    $_SESSION["error_order"] = $error_order;
                    header("location: order.php");
                }
                else
                {
                    $check[] = 1;
                    $home_address;
                }
            }

            //CHECK PHONE NUMBER
            if(isset($phone_number))
            {
                if(validate_phone($phone_number) === 0)
                {
                    $error_order[] = "Phone number must be digits only";
                    $_SESSION["error_order"] = $error_order;
                    header("location: order.php");
                }
                else
                {
                    $check[] = 1;
                    $phone_number;
                }
            }

            //CHECK EMAIL
            if(isset($email))
            {
                if(validate_email($email) === 0)
                {
                    $error_order[] = "Please input valid email";
                    $_SESSION["error_order"] = $error_order;
                    header("location: order.php");
                }
                else
                {
                    $check[] = 1;
                    $email;
                }
            }
        
            if(count($check)==4)
            {
                $prod = $product->view_cart($username); // GET ALL PRODUCTS IN CART
                $total = $product->get_Total($username); // GET TOTAL OF THE CART
                $product->add_shipping($total,$username,$first_name,$middle_name,$last_name,$home_address,$phone_number,$email,$order_status);
                $order_id = $product->get_shippingId($username);
                foreach($prod as $p)
                {
                    $p['product_id']; 
                    $p['product_quantity'];
                    $p['sub_total'];
                    $product->orders($order_id,$p['product_id'], $p['product_quantity'], $p['sub_total'],$username);
                }
                $product->clear_cart($username);
                header('location: user_product.php?category_id=1');
            }
    }

    if(isset($_GET['order_id'])&&isset($_GET['order_status'])) //TO VIEW ORDERS
    {
        $order_id = $_GET['order_id'];
        $order_status = $_GET['order_status'];
        $product->update_orderStatus($order_id,$order_status);
        header('location: user_order.php');
    }

?>