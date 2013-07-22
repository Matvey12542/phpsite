<?php
<<<<<<< HEAD
/*
 *                                     ...и жалко и радостно, что не видят
                                           исходных кодов пользователи...
                                       ...и плакать хочется, и радуешься,
                                      что не узрят они твои велосипеды...
                                        ...и никто не узнает что же там на
                                        самом деле...внутри...
                                        ...что не использовали мы стандартные
                                       функции, а что живем мы правильно,
                                       по-доброму...
                                      ...что все у нас хоть и криво, но родно...
 */

require_once ('../class/page_user.php');
require_once ('../class/newsdb.php');
require_once ('../class/db.php');
require_once '../class/dataProc.php';
=======
require_once ('../class/page_user.php');
require_once ('../class/newsdb.php');
require_once ('../class/db.php');
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
//require_once ('../class/addnews.php');

class index extends PageUser{
    
    public $lang = 'ru';

    public function __constract() {
        //session_start();
                
    }
    public function Left()
    {
        ?>
        <div id="nav">
                <ul>
                    <li><a href="../index.php"><?echo _("Home")?></a> </li>
                    <?
                    if (isset($_SESSION['login'])){
                        echo "<li><a href='../user/exit.php'>"._("Log out")."</a> </li>";
                    }
                    
                    ?>
                </ul>
                <ul>
                    <li><a href="../class/addnews.php"><?echo _("Add news");?></a></li>
<<<<<<< HEAD
                    <?
                    if (isset($_SESSION['role'])&&($_SESSION['role'] == 1)){
                        echo "<li><a href='../user/edituser.php'>"._("Edit users")."</a> </li>";
                    }
                    ?>
=======
                    
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
                </ul>
           </div>
                    
        <?php
    }
    
    public function Content() {
        echo '<div id="content">';
<<<<<<< HEAD
        if (isset($_SESSION['login'])){
            echo "<b>"._("Personal account. Hi ")." {$_SESSION['login']} </b>";
            echo ' <a href="showaccount.php">'._('User account').'</a>';
        }
=======
        if (isset($_SESSION['login']))
            echo "<b>"._("Personal account. Hi ")." {$_SESSION['login']} </b>";
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
        if (isset($_SESSION['mess'])){
            echo "<br>".$_SESSION['mess'];
            unset($_SESSION['mess']);
        }    
<<<<<<< HEAD
        
        $this->ShowNews($this->lang); 
        echo '</div>';
    }
    
    
    
=======
                        
        $this->ShowNews($this->lang);
        echo '</div>';
    }
    
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
    public function ShowNews($lang){
        $news = new NewsDb();
        $result = $news->Select($lang);
                    
        foreach ($result as $res){
            printf("<div><a href='../class/editnews.php?id=%s&lang=%s'>%s</a> ",$res['news_id'],$res['news_lang'],$res['news_title']);            
            echo "<a class='delete' href='../class/deletenews.php?id={$res['news_id']}&lang={$lang}'>"._('Delete')."</a></div>";
        }
    }
    
<<<<<<< HEAD
    
=======
>>>>>>> 33b27a05a0cf4b659b26183e6eef2f2a5fd9ff39
}
$page = new index();
$page->lang = Dataproc::lang();
$page->DisplayPage();
?>
