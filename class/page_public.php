<?php
/*function __autoload($class_name){
    require_once (strtolower($class_name).".php");
}*/
//session_start();
require_once 'dataProc.php';
require_once 'useronline.php';

class Page_public extends Dataproc{
    
       
    public function __constract() {
        
    }

    //Метод для виводу сторінки
    public function DisplayPage()
    {    
        $this->Header();
        $this->Left();
        $this->Content();
        $this->Footer();
    }
    
    public function Header()
    {
        ?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
        <html>
            <head>
                <title><?  echo _('Administrative page');?></title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <link rel="stylesheet" href="style.css">
            </head>

            <body>
                <div id="wraper">
                    <div id="header">
                        <div id="form">
                            <?$this->ShowLoginForm();?>
                        </div>
                        <h3 id="main_title"><?echo _('My first site using Object Oriented Programming')?></h3>
						<div id="lang">
		<?//echo _('Hellow')."<br>";
        echo "<a href='?lang=en'><img src='images/us.png' alt='ru'> </a><br>";
        echo "<a href='?lang=ru'><img src='images/ru.png' alt='ru'> </a><br>";?>
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
                    <li><a href="user/index.php"><?echo _("Administration")?></a> </li>
                    <li><a href="registration_form.php"><?echo _("Registration_form")?></a> </li>
                    
                </ul>        
                
                <?  $Counter = new UserOnline();                        //???
                    echo '<div class="online">';
                    echo '<p>'._('Users online- ').$Counter->getOnline().'</p>';
                    echo '<p>'._('Users all- ').$Counter->getAll().'</p>';
                    echo '</div>';
                ?>
                
                
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
    protected function ShowLoginForm()
    {
        if (isset($_SESSION['login']))
                  {
                    echo '<a href="user/exit.php">'._("Log out").'</a>';
                  }
                  else
                  {
          ?>
                    <form action="user/index.php" method="post">
                            
                              
                                    <?echo _('login:')?><input type="text" name="user_login">
                                    <?echo _('Password:')?><input type="password" name="user_pass">
                                    <input type="submit" class="submit" value="<?echo _('Enter')?>" name="login_form">
                                    
                                
                            
                    </form>
          <?php   }
    }
}
?>
