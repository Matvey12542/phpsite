<?php
require_once 'page_user.php';
require_once 'news.php';

class AddNews extends PageUser{
    public $title;
    public $text;
    public $lang;


    public function AuthorizationUser()
    {
        parent::AuthorizationUser();
                                
        switch ((int)$_SESSION['role'])
        {
            case 0:
                $_SESSION['mess'] = 'No role - No access';
                header("Location:../user/index.php");
                exit();
                break;
            case 1:
                break;
            case 2:
                
                break;
            case 3:
                $_SESSION['mess'] = $_SESSION['login'].' you are an ordinary user. No permission.';
                header("Location:../user/index.php");
                exit();
                break;
            case 4:
                $_SESSION['mess'] =  'No access. You was blocked';
                header("Location:../user/index.php");
                exit();
                break;
            default :
                $_SESSION['mess'] =  'No access Exception';
                header("Location:../user/index.php");
                    exit();
        }
        
    }


    public function Content() {
        echo '<div id="content">';
        ?>
<form action="addnews.php" method="post">
     <table>
            <tr><td><?echo _('Title news:')?></td><td><input type="text" name="title"></td></tr>
            <tr><td><?echo _('Language:')?></td><td>
                <select name="lang">
                    <option value="ru">Ru</option>
                    <option value="en">En</option>
                </select></td></tr>
            <tr><td><textarea rows="10" cols="45" name="text"></textarea></td></tr>
        
            <tr><td>&nbsp;</td><td><input type="submit" value="<?echo _('Add news')?>" name="addnews"></td></tr>
     </table>
</form>        
        <?
        if (isset($_POST['addnews'])){
            
            $this->title = $_POST['title'];
            $this->text = $_POST['text'];
            $this->lang = $_POST['lang'];
            
            if (empty($this->title)||empty($this->text))
            {
                echo _("Do not fill in the required fields");
                exit();
            }
            

            $this->Add($this->lang,$this->title,  $this->text);

        }
        echo '</div>';
    }
    public function Add($lang,$title,$text){
        $news = new News($lang,$title,$text);
        $newsdb = new NewsDb();
        if($newsdb->Insert($news)){
            $_SESSION['mess'] = _("News has been added");
            //header("Location:../user/index.php");
        }
    }
}

$page = new AddNews();
$page->lang = Dataproc::lang();
$page->DisplayPage();
?>
