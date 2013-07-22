<?php
require_once '../class/dataProc.php';
require_once '../class/page_user.php';
require_once 'userdb.php';
require_once '../class/image.php';


class Editaccount extends PageUser{
    public $imagename;


    public function Content() {
        echo '<div id="content">';
        $this->showAvatar();
        $this->showEmail();
        $this->showName();
        $this->showSurname(); 
        echo '</div>';
               
        
    }
    
    public function showAvatar(){
        
        $user = new UserDb();
        $img = $user ->selectAvatar($_SESSION['login']);
        if ($img['img'] == ''){
            $img['img'] = "def.png";
        }
        
        echo "<img src='../images/avatar/{$img['img']}' alt='avatar'>";
        
        if (isset($_POST['knopka'])&&!empty($_FILES['image']['name']    )){
            
            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/images/avatar/';
            $uploadfile = $uploaddir . basename($_FILES['image']['name']);
            $this->imagename = $_FILES['image']['name'];
            
           // echo '<pre>';
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                echo _("File is correct and has been successfully uploaded.");
            } else {
                echo "Возможная атака с помощью файловой загрузки!\n";
            }

            //echo 'отладочная информация:';
            //print_r($_FILES);
            //print "</pre>";*/

            $image = new Image();
            $image->load($uploadfile);
            $image->resize(150,150);
            $image->save($uploadfile);
            
            $user->replaceAvatar($this->imagename,$_SESSION['login']);
            
            echo "<img src='../images/avatar/$this->imagename' alt='avatar'>";
         
        }
        
        ?>
            <form enctype="multipart/form-data" action="editaccount.php" method="POST">

                <?echo _("Change avatar");?> <input type="file" name="image">
                <input type="submit" name="knopka" value="<?echo _('Upload');?>">

            </form>
        <?
       // var_dump($img);
    }
    function showName(){
        $user = new UserDb();
        $users = $user -> selectAll($_SESSION['login']);
        if ($users['name'] == ''){
            echo _('name not set');
        }else {echo _('Name - ').$users['name'];}
        
         if (isset($_POST['rename'])&&!empty($_POST['name'])){
            $user->replaceName($_POST['name'],$_SESSION['login']);            
        }
        
        ?>
            <form enctype="multipart/form-data" action="editaccount.php" method="POST">

                <?echo _("Change name");?> <input type="text" name="name">
                <input type="submit" name="rename" value="<?echo _('Change');?>">

            </form>
        <?
       
    }
    function showSurname(){
        $user = new UserDb();
        $users = $user -> selectAll($_SESSION['login']);
        if ($users['surname'] == ''){
            echo _('Surname not set');
        }else {echo _('Surname - ').$users['surname'];}
        
        if (isset($_POST['resurname'])&&!empty($_POST['surname'])){
            $user->replaceSurname($_POST['surname'],$_SESSION['login']);            
        }
        
        ?>
            <form enctype="multipart/form-data" action="editaccount.php" method="POST">

                <?echo _("Change surname");?> <input type="text" name="surname">
                <input type="submit" name="resurname" value="<?echo _('Change');?>">

            </form>
        <?
        
    }
    
    function showEmail(){
        $user = new UserDb();
        $users = $user -> selectAll($_SESSION['login']);
        if ($users['email'] == ''){
            echo _('email not set');
        }else {echo 'Email - '.$users['email'];}
        
         if (isset($_POST['reemail'])&&!empty($_POST['email'])){
            $user->replaceEmail($_POST['email'],$_SESSION['login']);
            //echo  '<br>'.$_POST['email'].$_SESSION['login'];
        }
        
        ?>
            <form enctype="multipart/form-data" action="editaccount.php" method="POST">

                <?echo _("Change email");?> <input type="text" name="email">
                <input type="submit" name="reemail" value="<?echo _('Change');?>">

            </form>
        <?
       
    }
        
}

$page = new Editaccount();
$page->lang = Dataproc::lang();
$page->DisplayPage();




?>

