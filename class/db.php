<?php

class db{
<<<<<<< HEAD
    protected $db_name = "shop";
=======
    protected $db_name = "test";
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
    protected $db_user = "root1";
    protected $db_pass = "root1";
    protected $db_host = "localhost";
    private static $instance = NULL;
    
    private function __construct(){}
    private function __clone(){}
    public static function getInstance(){
        if(!self::$instance){
<<<<<<< HEAD
            self::$instance = new PDO('mysql:host=localhost;dbname=shop', "kolya", "751392");
=======
            self::$instance = new PDO('mysql:host=localhost;dbname=test', "kolya", "751392");
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
            self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
        }
        return self::$instance;
    }
    
}
?>
