<?php 
    include('database.php');

    class MODEL
    {
        private $connect;

        function __construct()
        {
            $this->connect = Database::connect();
        }

        function add_product($category_id,$product_name,$product_price,$product_image,$product_description)
        {
            $query = "INSERT INTO products (category_id,product_name,product_price,product_image,product_description) VALUES (:category_id,:product_name,:product_price,:product_image,:product_description)";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':category_id',$category_id);
            $statement->bindValue(':product_name',$product_name);
            $statement->bindValue(':product_price',$product_price);
            $statement->bindValue(':product_image',$product_image);
            $statement->bindValue(':product_description',$product_description);
            $statement->execute();
        }

        function get_categories()
        {
            $query = "SELECT * FROM category";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            $stmnt = $statement->fetchAll();
            return $stmnt;
        }

        function get_products($category_id)
        {
            $query = "SELECT * FROM products WHERE category_id = :category_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':category_id',$category_id);
            $statement->execute();
            $stmnt = $statement->fetchAll();
            return $stmnt;
        }

        function delete_product($product_id)
        {
            $query = "DELETE FROM products WHERE product_id = :product_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':product_id',$product_id);
            $statement->execute();
        }   

        function select_product($product_id)
        {
            $query = "SELECT * FROM products WHERE product_id = :product_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':product_id',$product_id);
            $statement->execute();
            $stmnt = $statement->fetchAll();
            return $stmnt;
        }

        function update_product($category_id,$product_name,$product_price,$product_id,$product_description)
        {
            $query = "UPDATE products SET category_id = :category_id, product_name = :product_name, product_price = :product_price , product_description = :product_description WHERE product_id = :product_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':category_id', $category_id);
            $statement->bindValue(':product_name', $product_name);
            $statement->bindValue(':product_price', $product_price);
            $statement->bindValue(':product_id',$product_id);
            $statement->bindValue(':product_description', $product_description);
            $statement->execute();
        }

        function update_product2($category_id,$product_name,$product_price,$product_id,$product_image,$product_description)
        {
            $query = "UPDATE products SET category_id = :category_id, product_name = :product_name, product_price = :product_price, product_image = :product_image , product_description = :product_description WHERE product_id = :product_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':category_id', $category_id);
            $statement->bindValue(':product_name', $product_name);
            $statement->bindValue(':product_price', $product_price);
            $statement->bindValue(':product_id', $product_id);
            $statement->bindValue(':product_image', $product_image);
            $statement->bindValue(':product_description', $product_description);
            $statement->execute();
        }
        
        function register_user($usertype,$username,$passcode,$first_name,$middle_name,$last_name,$home_address,$phone_number,$email)
        {
            $query = "INSERT INTO user (username,passcode,user_type,first_name,middle_name,last_name,home_address,phone_number,email) VALUES (:username,:passcode,:usertype,:first_name,:middle_name,:last_name,:home_address,:phone_number,:email)";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':usertype', $usertype);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':passcode', $passcode);
            $statement->bindValue(':first_name', $first_name);
            $statement->bindValue(':middle_name', $middle_name);
            $statement->bindValue(':last_name', $last_name);
            $statement->bindValue(':home_address', $home_address);
            $statement->bindValue(':phone_number', $phone_number);
            $statement->bindValue(':email', $email);
            $statement->execute();
        }

        function count_username($username)
        {
            $query = "SELECT count(id_number) from user where username = :username";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->execute();
            $stmnt = $statement->fetch(); //COUNT ROWS
            return $stmnt[0];
        }

        function validateLogin($username, $sha_passcode, $user_type)
        {
            $query = "SELECT count(*) from user where username =:username and passcode =:passcode and user_type = :user_type";
            $statement = $this->connect->prepare($query);

            $values = [
                ':username' => $username,
                ':passcode' => $sha_passcode,
                ':user_type' => $user_type
            ];
            $statement->execute($values);
            $result = $statement->fetch();
            return $result[0];
        }

        function product_details($product_id) //RETRIEVE ITEM DETAILS
        {
            $query = "SELECT product_name,category_id,product_price,product_image,product_description from products where product_id = :product_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':product_id',$product_id);
            $statement->execute();
            $stmnt = $statement->fetchAll();
            return $stmnt;
        }

        function cart($cart_id,$product_id,$product_quantity,$sub_total,$username)
        {
            $query = "INSERT INTO cart (cart_id,product_id,product_quantity,sub_total,username) VALUES (:cart_id,:product_id,:product_quantity,:sub_total,:username)";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':cart_id',$cart_id);
            $statement->bindValue(':product_id',$product_id);
            $statement->bindValue(':product_quantity',$product_quantity);
            $statement->bindValue('sub_total',$sub_total);
            $statement->bindValue(':username',$username);
            $statement->execute();
        }

        function view_cart($username)
        {
            $query = "SELECT products.product_id,products.product_name,products.product_price,products.product_image,cart.product_quantity,cart.sub_total,cart.cart_id FROM products INNER JOIN cart ON products.product_id=cart.product_id WHERE username = :username";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':username',$username);
            $statement->execute();
            $stmnt = $statement->fetchAll();
            return $stmnt;
        }

        function check_cart($product_id)
        {
            $query = "SELECT count(*) from cart where product_id = :product_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':product_id',$product_id);
            $statement->execute();
            $result = $statement->fetch();
            return $result[0];
        }

        function get_quantity($product_id)
        {
            $query = "SELECT product_quantity from cart where product_id = :product_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':product_id',$product_id);
            $statement->execute();
            $result = $statement->fetch();
            return $result[0];
        }

        function update_quantity($product_id,$product_quantity,$username)
        {
            $query = "UPDATE cart SET product_quantity = :product_quantity WHERE product_id = :product_id AND username = :username";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':product_quantity', $product_quantity);
            $statement->bindValue(':product_id',$product_id);
            $statement->bindValue(':username',$username);
            $statement->execute();
        }

        function delete_cart($product_id)
        {
            $query = "DELETE FROM cart WHERE product_id = :product_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':product_id',$product_id);
            $statement->execute();
        }

        function get_user($username)
        {
            $query = "SELECT * FROM user where username = :username";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':username',$username);
            $statement->execute();
            $stmnt = $statement->fetchAll();
            return $stmnt;
        }
        
        function add_shipping($total,$username,$first_name,$middle_name,$last_name,$home_address,$phone_number,$email,$order_status)
        {
            $query = "INSERT INTO shipping (order_total,username,first_name,middle_name,last_name,home_address,phone_number,email,order_status) VALUES (:order_total,:username,:first_name,:middle_name,:last_name,:home_address,:phone_number,:email,:order_status)";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':order_total',$total);
            $statement->bindValue(':username',$username);
            $statement->bindValue(':first_name',$first_name);
            $statement->bindValue(':middle_name',$middle_name);
            $statement->bindValue(':last_name',$last_name);
            $statement->bindValue(':home_address',$home_address);
            $statement->bindValue(':phone_number',$phone_number);
            $statement->bindValue(':email',$email);
            $statement->bindValue(':order_status',$order_status);
            $statement->execute();
        }

        function cart_user($username)
        {
            $query = "SELECT COUNT(*) FROM cart WHERE username = :username";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':username',$username);
            $statement->execute();
            $stmnt = $statement->fetch();
            return $stmnt[0];
        }

        function get_lastCart() //GET LAST CART ID
        {
            $query = "SELECT cart_id FROM cart ORDER BY cart_id DESC LIMIT 1 ";
            $statement = $this->connect->query($query);
            $stmnt = $statement->fetch();
            return $stmnt[0];
        }

        function orders($order_id,$product_id,$product_quantity,$sub_total,$username)
        {
            $query = "INSERT INTO orders (order_id,product_id,product_quantity,sub_total,username) VALUES (:order_id,:product_id,:product_quantity,:sub_total,:username)";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':order_id',$order_id);
            $statement->bindValue(':product_id',$product_id);
            $statement->bindValue(':product_quantity',$product_quantity);
            $statement->bindValue('sub_total',$sub_total);
            $statement->bindValue(':username',$username);
            $statement->execute();
        }

        function clear_cart($username)
        {
            $query = "DELETE FROM CART WHERE username = :username";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':username',$username);
            $statement->execute();
        }

        function get_lastOrder()
        {
            $query = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1 ";
            $statement = $this->connect->query($query);
            $stmnt = $statement->fetch();
            return $stmnt[0];
        }

        function get_shippingId($username)
        {
            $query = "SELECT order_id FROM shipping WHERE username = :username ORDER BY order_id DESC LIMIT 1 ";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':username',$username);
            $statement->execute();
            $stmnt = $statement->fetch();
            return $stmnt[0];
        }

        function get_Total($username)
        {
            $query = "SELECT SUM(sub_total) as total FROM cart where username = :username";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':username',$username);
            $statement->execute();
            $stmnt = $statement->fetch();
            return $stmnt[0];
        }

        function get_order($username)
        {
            $query = "SELECT * FROM shipping where username = :username ORDER BY order_id DESC";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':username',$username);
            $statement->execute();
            $stmnt = $statement->fetchAll();
            return $stmnt;
        }

        function update_orderStatus($order_id,$order_status)
        {
            $query = "UPDATE shipping SET order_status = :order_status WHERE order_id = :order_id ORDER BY order_id DESC";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':order_id',$order_id);
            $statement->bindValue(':order_status',$order_status);
            $statement->execute();
        }

        function receipt($order_id)
        {
            $query = "SELECT products.product_name,products.product_price, orders.product_quantity, orders.sub_total FROM PRODUCTS INNER JOIN ORDERS ON products.product_id = orders.product_id WHERE orders.order_id = :order_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':order_id',$order_id);
            $statement->execute();
            $stmnt = $statement->fetchAll();
            return $stmnt;
        }

        function shipping_info($order_id)
        {
            $query = "SELECT CONCAT(first_name,' ',middle_name,' ',last_name) AS fullname , home_address , phone_number , order_id , order_date FROM shipping where order_id = :order_id";
            $statement = $this->connect->prepare($query);
            $statement->bindValue(':order_id',$order_id);
            $statement->execute();
            $stmnt = $statement->fetchAll();
            return $stmnt;
        }
    }
?>