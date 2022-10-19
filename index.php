<?php 
    // include('model.php');
    // $product = new MODEL();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include('header.php');
        $_SESSION["username"]; //SESSION USERNAME
        $_SESSION["user_type"];
    ?>
    <div class="input">
        <form action="process.php" method="POST" enctype="multipart/form-data">
            <label for="">Category: </label>
            <select name="category_id" id="">
                <?php 
                    $result = $product->get_categories();
                    foreach($result as $r)
                    { ?>
                        <option value="<?php echo $r['category_id']; ?>"> <?php echo $r['category_name']; ?> </option>
            <?php }
                ?>
            </select><br />
            <label for="">Name: </label>
            <input type="text" name="product_name"><br />
            <label for="">Price: </label>
            <input type="text" name="product_price"><br />
            <label for="">Description: </label><br />
            <textarea name="product_description" id="" cols="50" rows="10"></textarea><br />
            <input type="file" name="file1"><br />
            <input type="submit" name="add_product" value="Add Product">
        </form>
    </div>

</body>
</html>
