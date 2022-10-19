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
    <div class="product-container">
        <?php 
            $username = $_SESSION['username'];

            $product_id=$_GET['product_id'];
            $item = $product->product_details($product_id);
            foreach($item as $i)
            { 
                $product_price = $i['product_price'];
                $category_id = $i['category_id'];
                ?>
                <div class="image-container">
                    <img src="./images/<?php echo $i['product_image']; ?>" alt="" srcset="">
                </div>
                <div class="details-container">
                    <div class="name-container"><p><?php echo $i['product_name']; ?></p></div>
                    <div class="price-container"><p>₱ <?php echo $i['product_price']; ?></p></div>
                    <div class="description-container"><p><?php echo $i['product_description']; ?></p></div>
      <?php }
        ?>
                        <form action="process.php" method="POST">
                            <div class="quantity-container">
                                <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                                <label for="">Quantity</label>
                                <input type="number" name="product_quantity">    
                            </div>
                            <input type="submit" name="add-to-cart" value="Add to Cart" id="add-cart">
                        </form>
                </div>
    </div>
</body>
</html>