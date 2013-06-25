<?php
require_once 'newsdb.php';

class News /*extends NewsDb*/{
    
    private $visible = 1;
    private $lang;
    private $title;
    private $text;
    public $id;


    public function __construct($lang,$title,$text){
        $this->lang = $lang;
        $this->title = $title;
        $this->text = $text;
    }
    
    public function GetVisible(){
        return $this->visible;
    }
    public function GetLang(){
        return $this->lang;
    }
    public function GetTitle(){
        return $this->title;
    }
    public function GetText(){
        return $this->text;
    }
    
}

//$news = new News('ru','Заголовок','Текст статті');
//$newsdb = new NewsDb();
//$newsdb->Insert($news);

?>
