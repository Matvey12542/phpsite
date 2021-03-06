<?php
/*function __autoload($class_name){
    require_once (strtolower($class_name).".php");
}*/

require_once 'dataProc.php';


class PageUser extends Dataproc {
    public $login;
    public $password;
    
    public function __constract() {
        
         
    }
         
    public function DisplayPage()
    {
        $this->AuthorizationUser();
        $this->Header();
        $this->Left();
        $this->Content();
        $this->Footer();
    }

    
    public function AuthorizationUser()
    {
        if (!empty($_POST['user_login']) && !empty($_POST['user_pass']))
            {    
                $login = $this->CheckUserData($_POST['user_login']);
                $password = $this->CheckUserData($_POST['user_pass']);

                if(!empty($login)&&!empty($password))
                {
                    if($this->CheckLoginAndPasswd($login,$password))
                    {
                        $_SESSION['login'] = $login;
                        $_SESSION['role'] = $this->role();
                        $this->setLastVisit($login);
                        
                        if($_SESSION['role']==4){
                            unset($_SESSION['login']);
                            $_SESSION['mess'] = _('Your account has been locked');
                        }
                    }
                }
                
            else {
                $_SESSION['mess'] = _("You enter the wrong login information.");
                //header("Location:../user/index.php");
                //echo _("You enter the wrong login information.");
		}
            }  
        else {
            
            $this->CheckUserLogin();
        }
    }
    
    

    public function Header()
    {
        ?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
        <html>
            <head>
                <title><?  echo _('Administrative page');?></title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <link rel="stylesheet" href="../style.css">
                <link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
                
            </head>

            <body>
                <div id="wraper">
                    <div id="header">
                        <div id="form">
                            <?$this->ShowLoginForm();?>
                        </div>
                        <h3><?echo _('My first site using Object Oriented Programming')?></h3>
                                                                           
                            <div id="lang">
        <?//echo _('Hellow')."<br>";
        echo "<a href='?lang=en'><img src='../images/us.png' alt='en'> </a><br>";
        echo "<a href='?lang=ru'><img src='../images/ru.png' alt='ru'> </a><br>";?>
                            </div>
                    </div>
        <?php
    }
    
    public function Left()
    {
        ?>
        <div id="nav">
            
                <?
                if (isset($_SESSION['mess']))
                    {
                        echo "<br>"."<p id='mess'>".$_SESSION['mess']."</p>";
                        unset($_SESSION['mess']);
                    } 
                
                ?>
                <ul>
                    <li><a href="../index.php"><?echo _("Home")?></a> </li>
                    <?
                    if (isset($_SESSION['login'])){
                        echo "<li><a href='../user/exit.php'>"._("Log out")."</a> </li>";
                        echo "<li><a href='../user/index.php'>"._("News")."</a> </li>";

                                            
                        if (isset($_SESSION['role'])&&($_SESSION['role'] == 1)){
                            echo "<li><a href='../user/edituser.php'>"._("Edit users")."</a> </li>";
                        }                                       

                    }
                    
                    ?>
                </ul>        
           </div>
                    
        <?php
    }
    
    public function Content()
    {
        
    }
    public function Footer()
    {
        ?> 
                <div id="footer">
                        &copy; 2013 Matvey.
                    </div>
                </div>
            </body>
        </html>
        <?php
    }

/*    public function AuthorizationUser()
    {
            if (!empty($_POST['user_login']) && !empty($_POST['user_pass']))
            {    
                $login = $this->CheckUserData($_POST['user_login']);
                $password = $this->CheckUserData($_POST['user_pass']);

                if(!empty($login)&&!empty($password)){
                

                    if($this->CheckLoginAndPasswd($login,$password))
                    {$_SESSION['login'] = $login;}
					

                }
                
            else {
                $_SESSION['mess'] = _("You enter the wrong login information.");
                //header("Location:../user/index.php");
                //echo _("You enter the wrong login information.");
				
            }
            
                
           }  
        else {
            
            $this->CheckUserLogin();
        }
        
    }*/
   
    private function CheckLoginAndPasswd($login,$password)
    {
        
        try{
        $sql = "SELECT * FROM users WHERE login=:login AND password=:password";
        $stmt = db::getInstance()->prepare($sql);
        $stmt->bindValue(':login',$login);
        $stmt->bindValue(':password', md5($password));
        $stmt->execute();
		$count = $stmt->rowCount();
        $user=$stmt->fetchAll(PDO::FETCH_ASSOC);
        }  catch (PDOException $e){
        echo $e->getMessage();
        }
        if ($count == 1){
            
            return true;
        }else{
            //throw new Exception(_("You enter the wrong login information."));
            //echo _("You enter the wrong login information.");
            $_SESSION['mess'] = _("You enter the wrong login information.");
            header("Location:../user/index.php");
			//exit();
            return false;
        }
    }
    
    public function CheckUserLogin()
    {
        if(!isset($_SESSION['login']))
        {
            $this->Header();
            $this->Left();
            echo '<div id="content">'; 
            echo _("<a href='../index.php'>"._("Login or password is entered incorrectly.")."</a>");
            echo '</div>';
            $this->Footer();
            //header("Location:../index.php");
            exit;
        }
    }
    protected function ShowLoginForm()
    {
        if (isset($_SESSION['login']))
                  {
                    echo '<a href="../user/exit.php">'._("Log out").'</a>';
                  }
                  else
                  {
          ?>
                    <form action="../user/index.php" method="post">
                            
                              
                                    <?echo _('login:')?><input type="text" name="user_login">
                                    <?echo _('Password:')?><input type="password" name="user_pass">
                                    <input type="submit" class="submit" value="<?echo _('Enter')?>" name="login_form">
                                    
                                
                            
                    </form>
          <?php   }
    }
    
    function setLastVisit($login){
        
        $last_visited = date("Ymd");
         try{
            $sql = "UPDATE users SET last_visited = :last_visited WHERE login= :login";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':last_visited',  $last_visited);
            $stmt->bindValue(':login',  $login);
            $stmt->execute();
                     
            
        }  catch (PDOException $e){
        echo $e->getMessage();
        }
    }
    
    function role(){
        try{
            $sql = "SELECT role FROM users WHERE login= :login";
            $stmt = db::getInstance()->prepare($sql);
            $stmt->bindValue(':login',  $_SESSION['login']);
            $stmt->execute();
            $rez = $stmt->fetch(PDO::FETCH_ASSOC);
            $role = $rez['role'];
            
        }catch (PDOException $e){
        echo $e->getMessage();
        }
        return $role;
    }

}

?>
