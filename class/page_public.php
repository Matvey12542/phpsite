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
        <!DOCTYPE html>
        <html>
            <head>
                <title><?  echo _('Administrative page');?></title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <link rel="stylesheet" href="style.css" />
            </head>

            <body>
                <div id="wraper">
                    <div id="header">
                        <h3><?echo _('My first site using Object Oriented Programming')?></h3>
						<div id="lang">
		<?//echo _('Hellow')."<br>";
        echo "<a href='?lang=en'><img src='images/us.png' alt='ru'> </a><br />";
        echo "<a href='?lang=ru'><img src='images/ru.png' alt='ru'> </a><br />";?>
						</div>
                    </div>
        <?php
    }
    
    public function Left()
    {
        ?>
        <div id="nav">
                <ul>
                    <li><a href="user/index.php"><?echo _("Administration")?></a> </li>
                    <li><a href="registration_form.php"><?echo _("Registration_form")?></a> </li>
                    
                </ul>        
                
                <?  $Counter = new UserOnline();                        //???
                    echo _('Users online- ').$Counter->getOnline();
                    echo _('Users all- ').$Counter->getAll();
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
}
?>
