<?php

class db{

    protected $db_name = "shop";
    protected $db_user = "root1";
    protected $db_pass = "root1";
    protected $db_host = "localhost";
    private static $instance = NULL;
    
    private function __construct(){}
    private function __clone(){}
    public static function getInstance(){
        if(!self::$instance){

           self::$instance = new PDO('mysql:host=localhost;dbname=phpsite', "kolya", "751392");
           self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
        }
        return self::$instance;
    }
    
}
?>
