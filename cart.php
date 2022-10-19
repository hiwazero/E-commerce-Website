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
    <div class="cart-container">
        <?php

            if(isset($_SESSION['username'])) 
            {
                $total = 0;
                $_SESSION['username'];
                $product_detail = $product->view_cart($_SESSION['username']);
                foreach( $product_detail as $p)
                { ?> 
        <div class="product-details">
            <div class="product image">
                    <img src="./images/<?php echo $p['product_image']; ?>" style="height: 150px; width: 100%;"></img>
            </div>           
            <div class="product name">
                    <p><?php echo $p['product_name']; ?></p>
            </div>
            <div class="product price">
                    <p><?php echo "₱ ".$p['product_price']; ?></p>
            </div>
            <div class="product quantity">
                <a href="process.php?product_quantity=<?php echo $p['product_quantity']; ?>&subtract_quantity=1&product_id=<?php echo $p['product_id']; ?>"><button id="minus">-</button></a>
                    <p id="quantity"><?php echo $p['product_quantity']; ?></p>
                <a href="process.php?product_quantity=<?php echo $p['product_quantity']; ?>&add_quantity=1&product_id=<?php echo $p['product_id']; ?>"><button id="plus">+</button></a>
            </div>
            <div class="product subtotal">
                    <p>
                    <?php 
                          echo "₱ ".$subtotal = $p['product_price'] * $p['product_quantity']; 
                          $total = $subtotal + $total;  
                    ?>
                    </p>
            </div>
        </div>
        <?php           
                }
            }
        ?>
        <div class="checkout-container">
        <?php 
        if($total>0) 
        { ?>
        
            <div class="total">
                <p id="total">Total: </p> 
                <p id="money"><?php echo " "."₱".$total; ?></p>
            </div>
            
            <div class="total">
                <button><a href="order.php">Check Out</a></button>
                <?php 
        }
        else
        { ?>
                <p class="empty">No Items added in cart yet.</p>            
  <?php }
  ?>
        
            </div>
        </div> 
    </div>
</body>
</html>