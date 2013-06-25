<?php
/*function __autoload($class_name){
    require_once(strtolower($class_name).".php");
}*/
require_once 'db.php';
session_start();

class Dataproc{
        
    public function __constract(){
        
               
    }
   public static function lang()
    {
        if (isset($_SESSION['lang']))
        {
            $lang = addslashes($_SESSION['lang']);

        }else{
            $lang = "ru";    
        }

        if (isset($_GET["lang"])){
            $lang= addslashes($_GET["lang"]);
            $_SESSION['lang']=$lang;
        }

        if ($lang == "en"){
            $locale = "en_US";
        }
         else {
             $locale = "ru_RU.utf8";
        }
        putenv("LANG=$locale");
        //putenv("LANG=en_US");
        //setlocale(LC_ALL,"ru_RU.utf8");
        setlocale(LC_ALL,$locale);
        $domain = 'shop';
        bindtextdomain($domain,"./locale");
        textdomain($domain);
        bind_textdomain_codeset($domain, 'UTF-8');
        
        return $lang;
    }
    
    public function CheckUserData($var){
        $res = htmlspecialchars($var,ENT_QUOTES); //перевірка на вредоносні символи
        return addslashes($res);
    }
    
    public function loginExist($login){
        $sql = "SELECT * FROM users WHERE login=:login";
        $result = db::getInstance()->prepare($sql);
        $result->bindValue(':login',$login);
        $result->execute();
        $user=$result->fetchAll(PDO::FETCH_ASSOC);
        if (count($user) == 0){
            return true;
        }
        else {
            return false;
        }
    }
    public function register(){
        try{
            $sql = "INSERT INTO users (login, password, email, name, city, status) VALUES (:login,:pass,:email, :name, :city, :status)";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':login',  $this->login);
            $stmt->bindValue(':pass',  $this->password);
            $stmt->bindValue(':email',  $this->email);
            $stmt->bindValue(':name',  $this->name);
            $stmt->bindValue(':city',  $this->city);
            $stmt->bindValue(':status',  $this->status);
            $stmt->execute();
            //echo "Было затронуто строк ".$stmt->rowCount()."<br>";
            //echo "Id последней записи  ".db::getInstance()->lastInsertId()."<br>";
            echo _("User $this->login added");
            echo _("<br /><a href='index.php'>Home</a>");
            
        }  catch (PDOException $e){
        echo $e->getMessage();
        }
    
        return;
    }
}

?>
