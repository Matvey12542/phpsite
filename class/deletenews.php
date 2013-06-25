<?php
require_once 'page_user.php';
require_once 'news.php';

class Edit extends PageUser{
    public $title;
    public $text;
    public $lang;
    public $id='';


    public function Content() {
        echo '<div id="content">';
                        
        if(isset($_GET['id'])&&isset($_GET['lang']))
        {
            $id = (int)$_GET['id'];
            $this->lang = htmlspecialchars($_GET['lang']);
        }else   {exit("Неверние данные");}
        
        $res = $this->DeleteNews($id,  $this->lang);
        
       
        echo '</div>';
    }
    
    public function DeleteNews($id,$lang){
        
        $newsdb = new NewsDb();
        if($newsdb->Delete($id,$lang)){
            $_SESSION['mess'] = _("News has been deleted");
            header("Location:../user/index.php");
        }
    }
}

$page = new Edit();
$page->lang = Dataproc::lang();
$page->DisplayPage();

?>

