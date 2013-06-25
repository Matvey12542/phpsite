<?php
require_once 'db.php';

class Users{
    public $login;
    public $password;
    public $email;
    public $name;
    public $city;
    public $status=1;

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
            echo "Было затронуто строк ".$stmt->rowCount()."<br>";
            echo "Id последней записи  ".db::getInstance()->lastInsertId()."<br>";
        
        }  catch (PDOException $e){
        echo $e->getMessage();
        }
    
    return;
    }
    
    public function login($login,$password){
        try{
        $sql = "SELECT * FROM users WHERE login=:login AND password=:password";
        $stmt = db::getInstance()->prepare($sql);
        $stmt->bindValue(':login',$login);
        $stmt->bindValue(':password',$password);
        $stmt->execute();
        $user=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }  catch (PDOException $e){
        echo $e->getMessage();
        }
        if (count($user) == 1){
            
            return true;
        }else{
            
            return false;
        }
    
    }

}
?>