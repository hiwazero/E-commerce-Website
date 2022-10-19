<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<header>
    <?php include('header.php'); ?>
</header>
<body>
    <?php 
        $username = $_SESSION['username'];
    ?>
        <div class="order-container">
            <div class="table-header">
                <div class="table head1">Order Id</div>
                <div class="table head2">Order Date</div>
                <div class="table head3">Status</div>
                <div class="table head4">Delivered?</div>
                <div class="table head5">Receipt</div>
            </div>
    <?php 
        $prod = $product->get_order($username);
        foreach($prod as $p)
        { ?>
            <div class="order-list">
                <div class="order id">
                    <?php echo $p['order_id']; ?>
                </div>
                <div class="order date">
                    <?php echo $p['order_date']; ?>
                </div>
               <div class="order status">
                    <?php 
                        if($p['order_status']==1)
                            echo "Delivered";
                        else
                            echo "Processing";
                    ?>
               </div>
               <div class="order trigger">
                    <?php if($p['order_status']==0){ ?>
                        <a href="process.php?order_id=<?php echo $p['order_id']; ?>&order_status=1"><button>Received</button></a>
                    <?php }
                        else 
                        echo "Received";
                    ?>
               </div>
               <div class="order receipt">
                        <a href="receipt.php?order_id=<?php echo $p['order_id']; ?>"><button>View receipt</button></a>
               </div>
            </div>     
  <?php }
    ?>
        </div>    
</body>
</html>