<?php
require_once '../class/dataProc.php';
require_once '../class/page_user.php';
require_once 'userdb.php';



class Showaccount extends PageUser{
    public $imagename;


    public function Content() {
        echo '<div id="content">';
        
        $user = new UserDb();
        $result= $user->selectAll($_SESSION['login']);
        
        
         echo "<p id='edacc'><a href='editaccount.php'>"._("Edit account")."</a></p>";
         echo "<p id='delacc'><a href='deleteaccount.php'>"._("Delete account")."</a></p>";
        /*echo '<pre>';
        var_dump($result['img']);
        echo '</pre>';*/
        $img = $result['img'];
        if ($img == '')
        {
            $img = "def.png";
        }
        echo "<img src='../images/avatar/{$img}' alt='avatar'>";    //avatar
        
        // email
        if ($result['email'] == ''){
            echo '<p>'._('email not set').'</p>';
        }else {echo '<p> Email - '.$result['email'].'</p>';}
        
        //name
        if ($result['name'] == ''){
            echo '<p>'._('name not set').'</p>';
        }else {echo '<p>'._('Name - ').$result['name'].'</p>';}
        
        //surname
        if ($result['surname'] == ''){
            echo '<p>'._('Surname not set').'</p>';
        }else {echo '<p>'._('Surname - ').$result['surname'].'</p>';}
        
        //register data
        if ($result['data'] == '0000-00-00'){
            echo '<p>'._('Registration data not set').'</p>';
        }else {echo '<p>'._('registration data - ').$result['data'].'</p>';}
        
        //last visited
        if ($result['last_visited'] == '0000-00-00'){
            echo '<p>'._('Last visited data not set').'</p>';
        }else {echo '<p>'._('Last visited - ').$result['last_visited'].'</p>';}
        
        echo '</div>';
    }
    
    
    
    
        
}

$page = new Showaccount();
$page->lang = Dataproc::lang();
$page->DisplayPage();




?>


