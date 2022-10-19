<?php 
 include('header.php');
//  include('model.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
        $product = new MODEL();
        $result = $product->get_categories();

        //NAVIGATION LIST OF CATEGORIES
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
                        <a href="admin_product.php?category_id=<?php echo $r['category_id']; ?>"><li><?php echo $r['category_name'];?></li></a>
                    </ul>
    <?php   }
    ?>
        </div>
       
            <div class="product-view">
                    
                <div class="product-header">
                    <div class="product head1">Product</div>
                    <div class="product head2">Name</div>
                    <div class="product head3">Price</div>
                    <div class="product head4">Action</div>
                </div>
                
                    <?php
                        $result = $product->get_products($_GET['category_id']); 
                        foreach($result as $r)
                        { ?>
                            <div class="product-list">
                                <div class="product img"><img src="./images/<?php echo $r['product_image']; ?>" alt=""></img></div>
                                <div class="product name"><?php echo $r['product_name']; ?></div>
                                <div class="product price"><?php echo "₱".$r['product_price']; ?></div>
                                <div class="product action update">
                                    <a href="process.php?option=1&product_image=<?php echo $r['product_image'];?>&product_id=<?php echo $r['product_id']?>&category_id=<?php echo $r['category_id']; ?>"><button>Update</button></a>
                                </div>
                                <div class="product action delete">
                                    <a href="process.php?product_id=<?php echo $r['product_id']?>&option=2&product_image=<?php echo $r['product_image'];?>&category_id=<?php echo $r['category_id']; ?>"><button>Delete</button></a>
                                </div>
                            </div>
                <?php }
                    ?>
            </div>
       
        <!-- <table> -->
            <?php
            if(isset($_GET['category_id'])&&isset($_GET['product_id']))
            { 
                    
                        $product_id = $_GET['product_id']; 
                        $result = $product->select_product($product_id); ?>
                        <br />

                        <div class="update-form">
                                <form action="process.php" method="POST" enctype="multipart/form-data">
                                <select name="category_id" id="">
                                        <?php 
                                            $result2 = $product->get_categories();
                                            foreach($result2 as $r)
                                            { ?>
                                                <option value="<?php echo $r['category_id']; ?>"> <?php echo $r['category_name']; ?> </option>
                                    <?php }
                                        ?>
                                </select> <br />
                                <input type="file" name="file1"><br />
                        <?php foreach($result as $r)
                                { ?>
                                        <input type="hidden" name="product_id" value="<?php echo $r['product_id']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $r['product_image']; ?>">
                                        <input type="text" name="product_name" value="<?php echo $r['product_name']; ?>"><br />
                                        <input type="text" name="product_price" value="<?php echo $r['product_price']; ?>"><br />
                                        <label for="">Description: </label><br />
                                        <textarea name="product_description" id="" cols="50" rows="10"><?php echo $r['product_description']; ?></textarea><br />
                                        <input type="submit" name="save" value="Save">
                                    </form>
            <?php               }
            }
            ?>
                    </div>
</body>
</html>