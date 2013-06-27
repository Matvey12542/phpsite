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
        
        if (isset($_POST['editnews'])){
            
            $this->title = $_POST['title'];
            $this->text = $_POST['text'];
            $this->lang = $_POST['lang'];
            $id = $_POST['id'];
            
            if (empty($this->title)||empty($this->text)){
                echo _("Do not fill in the required fields");
                exit();
            }
            
            $this->Update($id, $this->lang,$this->title,$this->text);
        }
        
        
        if(isset($_GET['id'])&&isset($_GET['lang']))
        {
            $id = (int)$_GET['id'];
            $this->lang = mysql_real_escape_string($_GET['lang']);
        }else   {
            if(isset($_SESSION['mess'])){
                echo _("News has been edit");
                exit;
            }  else {
                exit("Неверние данные");
            }
            
            
        }
        
        $res = $this->SelectNews($id);
        
        
        
       ?>

<form action="editnews.php" method="post">
     <table>
            <tr><td><?echo _('Title news:')?></td><td>
                    <? echo '<input type="text" name="title" value="'.$res[0]['news_title'].'">'; ?>
                                                                                </td></tr>
            <tr><td><?echo _('Language:')?></td><td>
                <? echo "<input type='hidden' name='id' value='{$res[0]['news_id']}'>"; ?>
                <select name="lang">
                    <?if ($this->lang == 'ru')
                      {
                        echo '<option selected value="ru">ru</option>';
                        echo '<option value="en">en</option>';
                      }  
                      else 
                      {
                        echo '<option value="ru">ru</option>';
                        echo '<option selected value="en">en</option>';
                      }
                    ?>
                </select></td></tr>
            <tr><td>
            <? echo "<textarea rows='10' cols='45' name='text'>{$res[0]['news_text']}</textarea>"; ?>
                
            </td></tr>
        
            <tr><td>&nbsp;</td><td><input type="submit" value="<?echo _('Edit')?>" name="editnews"></td></tr>
     </table>
</form>        
<?
        
        echo '</div>';
    }
    
    public function SelectNews($id)
    {
        $news = new NewsDb();
        $result = $news->SelectForId($id,$this->lang);
                
        return $result;            
    }
    

    public function Update($id,$lang,$title,$text){
        $news = new News($lang,$title,$text);
        $news->id = $id;
        $newsdb = new NewsDb();
        if($newsdb->UpdateForId($news)){
            $_SESSION['mess'] = _("News has been edit");
            //header("Location:../user/index.php");
        }
    }
}

$page = new Edit();
$page->lang = Dataproc::lang();
$page->DisplayPage();

?>
