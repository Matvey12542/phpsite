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
    public function Header()
    {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title><?  echo _('Administrative page');?></title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <link rel="stylesheet" href="../style.css" />
            </head>

            <body>
                <div id="wraper">
                    <div id="header">
                        <h3><?echo _('My first site using Object Oriented Programming')?></h3>
						<div id="lang">
        <?//echo _('Hellow')."<br>";
        echo "<a href='?lang=en'><img src='../images/us.png'> </a><br />";
        echo "<a href='?lang=ru'><img src='../images/ru.png'> </a><br />";?>
						</div>
					</div>
        <?php
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
                        echo "<li><a href='../user/index.php'>"._("News")."</a> </li>";
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
                        &copy; 2013 ПП Matvey.
                    </div>
                </div>
            </body>
        </html>
        <?php
    }
    
    public function AuthorizationUser()
    {
            if (!empty($_POST['user_login']) && !empty($_POST['user_pass']))
            {    
                $login = $this->CheckUserData($_POST['user_login']);
                $password = $this->CheckUserData($_POST['user_pass']);

                if(!empty($login)&&!empty($password)){
                
                try {
                    if($this->CheckLoginAndPasswd($login,$password))
                    {$_SESSION['login'] = $login;}
					

               } catch (Exception $exc) {
                    echo $exc->getMessage();
                    exit;
                }}
                
            else {
                echo _("You enter the wrong login information.");
				
            }
            
                
           }  
        else {
            
            $this->CheckUserLogin();
        }
        
    }
    
    private function CheckLoginAndPasswd($login,$password)
    {
        
        try{
        $sql = "SELECT * FROM users WHERE login=:login AND password=:password";
        $stmt = db::getInstance()->prepare($sql);
        $stmt->bindValue(':login',$login);
        $stmt->bindValue(':password',$password);
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
            echo _("You enter the wrong login information.");
			exit();
            return false;
        }
    }
    
    public function CheckUserLogin()
    {
        if(!isset($_SESSION['login']))
        {
            $this->Header();
            $this->Left();
            echo _("<a href='../index.php'>"._("Login or password is entered incorrectly.")."</a>");
            $this->Footer();
            //header("Location:../index.php");
            exit;
        }
    }
}

?>
