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
    <?php include('header.php'); ?>
</header>
<body>
    <?php
        $product = new MODEL();
        $result = $product->get_categories();

        $category_id = 1;
        if(isset($_GET['category_id']))
            {
                $category_id = $_GET['category_id'];
            }
        else
            {
                $category_id = 1;
            } ?>
        <div class="categories">
        <?php foreach($result as $r)
            { ?>
                    <ul>
                        <a href="user_product.php?category_id=<?php echo $r['category_id']; ?>"><li><?php echo $r['category_name'];?></li></a>
                    </ul>
    <?php   }
    ?>
        </div>

    <div class="item-container">  
        <?php
            $result = $product->get_products($_GET['category_id']); 
            foreach($result as $r)
            { ?>
                <div class="item-card" style="border: 1px solid red;">
                    <img src="./images/<?php echo $r['product_image']; ?>" alt=""></img>
                    <p id="item-name"><?php echo $r['product_name']; ?></p>
                    <p id="item-price"><?php echo "₱".$r['product_price']; ?></p>
                    <?php 
                        if(isset($_SESSION["username"]))
                        {
                    ?>
                        <div class="purchase"><button><a href="process.php?product_id=<?php echo $r['product_id']; ?>">Purchase</a></button></div>
                    <?php 
                        }   
                        else
                        { ?>   
                        <div class="purchase"><button><a href="login.php">Purchase</a></button></div>
                <?php }
                    ?>
                </div>
      <?php } ?>
    </div>
</body>
</html>