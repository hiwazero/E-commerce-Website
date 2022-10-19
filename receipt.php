<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
</head>
<header>
    <?php include('header.php'); ?>
</header>
<body>
    <?php
        if(isset($_GET['order_id']))
        {
            $order_id = $_GET['order_id'];
        }

        $info = $product->shipping_info($order_id); ?>

        <div class="receipt-container">
            <div class="user-details">
                <?php
                    foreach($info as $i)
                    { ?>
                        <div class="receipt one">
                            <div class="receipt order">
                                <p>Order: </p>
                                <?php echo $i['order_id']; ?>
                            </div>
                            <div class="receipt date">
                                <p>Date: </p>
                                <?php echo $i['order_date']; ?>
                            </div>
                        </div>

                        <div class="receipt two">
                            <div class="receipt name">
                                <p>Customer: </p>
                                <?php echo $i['fullname']; ?>
                            </div>
                            <div class="receipt address">
                                <p>Address: </p>
                                <?php echo $i['home_address']; ?>
                            </div>
                            <div class="receipt contact">
                                <p>Contact: </p>
                                <?php echo $i['phone_number']; ?>
                            </div>
                        </div>
            <?php  } ?>
            </div>

                <?php
                $prod = $product->receipt($order_id); ?>

                <div class="item-details">
                    <div class="item-header">
                        <div class="item label">
                            <p>Item</p>
                        </div>
                        <div class="item pricelabel">
                            <p>Price</p>
                        </div>
                        <div class="item quantity">
                            <p>Quantity</p>
                        </div>
                        <div class="item sub_total">
                            <p>SubTotal</p>
                        </div>
                    </div>
                
                <?php 
                    $total = 0;
                    foreach($prod as $p)
                    { 
                       
                        ?>
                        <div class="item-card">
                            <div class="item product">
                                <?php echo $p['product_name']; ?>
                            </div>
                            <div class="item quantity">
                                <?php echo $p['product_price']; ?>
                            </div>
                            <div class="item quantity">
                                <?php echo $p['product_quantity']; ?>
                            </div>
                            <div class="item subtotal">
                                <?php echo $p['sub_total']; ?>
                            </div>
                        </div>          
                                <?php $total = $total + $p['sub_total']; ?>   
            <?php } ?>
                            <div class="item-total">
                                <p>Total: <?php echo $total; ?></p>
                            </div>
                        
                </div>
       </div>
</body>
</html>