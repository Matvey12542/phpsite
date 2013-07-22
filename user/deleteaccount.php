<?php
require_once '../class/dataProc.php';
require_once '../class/page_user.php';
require_once 'userdb.php';


class Deleteaccount extends PageUser{
    public function Content() {
       
        
        if(isset($_POST['yes']))
        {
            
            $user = new UserDb();
            $user -> deleteaccount($_SESSION['login']);
            unset($_SESSION['login']);
            $_SESSION['mess']="account has been deleted.";
            header("Location: ../index.php ");            
        }
        
        if(isset($_POST['no']))
        {
            header("Location: showaccount.php ");
        }
        
         echo '<div id="content">';
        echo _('Are you sure you want to delete your profile?');
         ?>
            <form action="deleteaccount.php" method="POST">
                <input type="submit" name="yes" value="<?echo _('Delete');?>">
                <input type="submit" name="no" value="<?echo _('Cancel');?>">
            </form>
        <?
        echo '</div>';
    }
}

$page = new Deleteaccount();
$page->lang = Dataproc::lang();
$page->DisplayPage();

?>
