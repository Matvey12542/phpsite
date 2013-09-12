<?php
require_once '../class/dataProc.php';
require_once ('../class/page_user.php');
require_once ('../class/newsdb.php');
require_once ('../class/db.php');

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
                    
                    <?
                    if (isset($_SESSION['role'])&&($_SESSION['role'] == 1)){
                        echo "<li><a href='../user/edituser.php'>"._("Edit users")."</a> </li>";
                    }
                    //var_dump($_SESSION['role']);
                    ?>

                </ul>
           </div>
                    
        <?php
    }
    
    public function Content() {
        echo '<div id="content">';

        if (isset($_SESSION['login'])){
            echo "<h3 class='hedadm'>"._("Personal account</h3> <p id='hi'> Hi ")." {$_SESSION['login']} ";
            echo ' <a id="account" href="showaccount.php">'._('User account').'</a></p>';
        }

        if (isset($_SESSION['mess'])){
            echo "<br>"."<p id='mess'>".$_SESSION['mess']."</p>";
            unset($_SESSION['mess']);
        }    


                        
        $this->ShowNews($this->lang);
        echo '</div>';
    }

    public function ShowNews($lang){
        $news = new NewsDb();
        $result = $news->Select($lang);
                    
        foreach ($result as $res){
            printf("<div><a href='../class/editnews.php?id=%s&lang=%s'>%s</a> ",$res['news_id'],$res['news_lang'],$res['news_title']);            
            echo "<a class='delete' href='../class/deletenews.php?id={$res['news_id']}&lang={$lang}'>"._('Delete')."</a></div>";
        }
    }
    


}
$page = new index();
$page->lang = Dataproc::lang();
$page->DisplayPage();
?>
