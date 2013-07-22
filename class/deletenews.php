<?php
require_once 'page_user.php';
require_once 'news.php';

class Edit extends PageUser{
    public $title;
    public $text;
    public $lang;
    public $id='';
<<<<<<< HEAD
            
    public function AuthorizationUser()
    {
        parent::AuthorizationUser();
        $newsdb = new NewsDb();
        $rez= $newsdb->SelectForId((int)$_GET['id'],htmlspecialchars($_GET['lang']));
                
        $author = $rez[0]['news_author'];
                        
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
                if ($author==$_SESSION['login'])
                {
                    
                }
                else 
                {
                    $_SESSION['mess'] =  'No access';
                    header("Location:../user/index.php");
                    exit();
                }
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
=======
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39


    public function Content() {
        echo '<div id="content">';
                        
<<<<<<< HEAD
        echo '<pre>';
        var_dump($_SESSION['role']);
        echo '</pre>';
        
=======
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
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

