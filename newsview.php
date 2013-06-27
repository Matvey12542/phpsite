<?php
require_once 'class/page_public.php';
require_once 'class/news.php';

class NewsViev extends Page_public{
    
    public $lang;
    public $id='';

    public function Content()
    {
        
        echo '<div id="content">'; 
                
        if(isset($_GET['id'])&&isset($_GET['lang']))
        {
            $this->id = (int)$_GET['id'];
            $this->lang = mysql_real_escape_string($_GET['lang']);
        }
        else {
            echo _("Wrong data");
            exit();
        }
        
        if (!empty($_SESSION['login'])){
            echo "<span class='linku'><a href='../class/editnews.php?id={$this->id}&lang={$this->lang}'>"._('Edit')."</a></span>";
            echo "<span class='linku'><a href='../class/deletenews.php?id={$this->id}&lang={$this->lang}'>"._('Delete')."</a></span>";
        }
        
        $this->ShowthisNews($this->id);
                          
                            
        echo '</div>';
        
    }
    
    public function ShowthisNews($id){
        $news = new NewsDb();
        $result = $news->SelectForId($id,$this->lang);
        
        //var_dump($result);
        
        echo "<h3 class='title_news'>".$result[0]['news_title']."</h3>";
        echo "<p class='text_news'>".$result[0]['news_text']."</p>";
        }
}


$page = new NewsViev();
Dataproc::lang();
$page->DisplayPage();
 
?>
