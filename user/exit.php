<?php
require_once ('../class/page_user.php');


class ExitPage extends PageUser{
    public function Content() 
    {
         echo '<div id="content">'; 
        //unset($_SESSION['login']);
        //$_SESSION['login']='';
        echo '<a href="../index.php">'._("You went out of your personal account!").'</a>';
        //echo $_SESSION['login'];
        
        //$_SESSION['mess'] = _("Goodbye");
        //header("Location:../index.php");
        echo '</div>';
    }
     public function Left()
    {
         unset($_SESSION['login']);
        
         ?>
        <div id="nav">
                <ul>
                    <li><a href="../index.php"><?echo _("Home")?></a> </li>
                    <?
                    if (isset($_SESSION['login']))
                    {
                      echo '<li><a href="../user/exit.php">'._("Log out").'</a> </li>';
                    }
                    ?>
                    
                </ul>        
           </div>
                    
        <?php
    }
}

$page1 = new ExitPage();
Dataproc::lang();
$page1->DisplayPage();
?>
