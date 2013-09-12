<?php
require_once '../class/db.php';

class UserDb{
    public function selectAvatar($login){
        
        try{
            $sql = "SELECT img FROM users WHERE login=:login";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':login',$login);
            $stmt->execute();
            $img = $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e){
            echo $e->getMessage();            
        }
        //unset($news[0]);
        return $img;
    }
    function replaceAvatar($imagename,$login){
        try{
            
            $sql = "Update users SET img=:img WHERE login=:login";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':img',$imagename);
            $stmt->bindValue(':login',$login);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();}        
    }
    public function selectAll($login){
        try{
            $sql = "SELECT * FROM users WHERE login=:login";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':login', $login);
            $stmt->execute();
            $users = $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e){
            echo $e->getMessage();            
        }
        //unset($news[0]);
        return $users;
    }
    public function selectAllUser(){
        try{
            $sql = "SELECT * FROM users";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e){
            echo $e->getMessage();            
        }
        //unset($news[0]);
        return $users;
    }
    function replaceEmail($email,$login){
        try{
            
            $sql = "Update users SET email=:email WHERE login=:login";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':email',$email);
            $stmt->bindValue(':login',$login);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();}
    }
    
    function replaceName($name,$login){
        try{
            
            $sql = "Update users SET name=:name WHERE login=:login";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':name',$name);
            $stmt->bindValue(':login',$login);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();}
    }
    function replaceSurname($surname,$login){
        try{
            
            $sql = "Update users SET surname=:surname WHERE login=:login";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':surname',$surname);
            $stmt->bindValue(':login',$login);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();}
    }
    function replaceRole($id,$role){
        try{
            
            $sql = "Update users SET role=:role WHERE id=:id";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':role',$role);
            $stmt->bindValue(':id',$id);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();}
    }
    
    function deleteaccount($login){
        try{
            
            $sql = "DELETE FROM users WHERE login=:login";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':login',$login);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();}
    }
    
    function deleteuser($id){
        try{
            
            $sql = "DELETE FROM users WHERE id=:id";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':id',$id);
            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();}
    }
}

?>
