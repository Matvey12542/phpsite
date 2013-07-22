<?php
require_once 'db.php';

class NewsDb{
    
    public function __construct(){
        
    }
    
    public function SelectForId($id,$lang){
        try{
            $sql = "SELECT * FROM newsopt,news WHERE news_lang=:lang AND newsopt.news_id=:id AND news.news_id=:id1";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':id',$id);
            $stmt->bindValue(':id1',$id);
            $stmt->bindValue(':lang',$lang);
            $stmt->execute();
            $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e){
            echo $e->getMessage();            
        }
        //unset($news[0]);
        return $news;
    }
    
    public function Select($lang){
        try{
                        
            $sql = "SELECT * FROM newsopt,news WHERE news_lang=:lang AND newsopt.news_id = news.news_id";
            $stmt = db::getInstance()->prepare($sql);
            //$stmt->bindValue(':news_id',$id);
            $stmt->bindValue(':lang',$lang);
            $stmt->execute();
            $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(PDOException $e){
            echo $e->getMessage();            
        }
        return $news;
    }
    
    public function Insert($obj){
        $date = date("y.m.d",  time());
        $visible = $obj->GetVisible();
        $lang = $obj->GetLang();
        $title = $obj->GetTitle();
        $text = $obj->GetText();
<<<<<<< HEAD
        $author = $_SESSION['login'];
=======
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
        //$id = db::getInstance()->lastInsertId()+5;
        
        
        
        try{
        $sql = "INSERT INTO newsopt (news_date,news_visible) VALUES(:date,:visible)";
        $stmt = db::getInstance()->prepare($sql);
        $stmt->bindValue(':date',$date);
        $stmt->bindValue(':visible',$visible);
        $stmt->execute();
        
<<<<<<< HEAD
        $sql = "INSERT INTO news (news_id,news_lang,news_title,news_text,news_author) VALUES(:id,:lang,:title,:text,:news_author)";
=======
        $sql = "INSERT INTO news (news_id,news_lang,news_title,news_text) VALUES(:id,:lang,:title,:text)";
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
        $stmt = db::getInstance()->prepare($sql);
        $stmt->bindValue(':id',db::getInstance()->lastInsertId());
        $stmt->bindValue(':lang',$lang);
        $stmt->bindValue(':title',$title);
        $stmt->bindValue(':text',$text);
<<<<<<< HEAD
        $stmt->bindValue(':news_author',$author);
=======
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
        $stmt->execute();
        
        
        }catch(PDOException $e){
            echo $e->getMessage();
            return FALSE;
        }
        return true;
    }
    public function UpdateForId($obj){
        $date = date("y.m.d");
        $visible = $obj->GetVisible();
        $lang = $obj->GetLang();
        $title = $obj->GetTitle();
        $text = $obj->GetText();
        $id = $obj->id;
        
                
        try{
        $sql = "Update newsopt SET news_date=:date,news_visible=:visible WHERE news_id=:id";
        $stmt = db::getInstance()->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':date',$date);
        $stmt->bindValue(':visible',$visible);
        $stmt->execute();
        
        $sql = "Update news SET news_lang=:lang,news_title=:title,news_text=:text WHERE news_id=:id";
        $stmt = db::getInstance()->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':lang',$lang);
        $stmt->bindValue(':title',$title);
        $stmt->bindValue(':text',$text);
        $stmt->execute();
        
        
        }catch(PDOException $e){
            echo $e->getMessage();
            return FALSE;
        }
        return true;
    }
    public function Delete($id,$lang){
        
        try{
        $sql = "DELETE FROM newsopt WHERE news_id=:id";
        $stmt = db::getInstance()->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        
        $sql = "DELETE FROM news WHERE news_id=:id AND news_lang=:lang";
        $stmt = db::getInstance()->prepare($sql);
        $stmt->bindValue(':id',$id);
        $stmt->bindValue(':lang',$lang);
        $stmt->execute();
        
        
        }catch(PDOException $e){
            echo $e->getMessage();
            return FALSE;
        }
        return true;
    }
}

?>
