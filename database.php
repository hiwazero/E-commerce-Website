<?php 
    class Database
    {
        private static $dsn = 'mysql:host=localhost;dbname=ryan_store';
        private static $username = 'root';
        private static $password = '';
        private static $connect;

        public static function connect()
        {
            if(!isset(self::$connect))
            {
                try{
                    self::$connect = new PDO(self::$dsn,self::$username,self::$password);
                    self::$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    // echo 'connected';
                  
                }catch(PDOException $e){
                    echo "Connection Failed: ".$e->getMessage();
                }
             }
             return self::$connect;
        }
    }
    Database::connect();
?>