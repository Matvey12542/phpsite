<?php
require_once 'class/page_public.php';

class Registration extends Page_public{
    public $login;
    public $password;
    public $password2;
    public $email;
    public $name;
    public $city;
    public $status=1;
    
    public function Content(){
        
        echo '<div id="content">';
        echo '<div id="mess">';
        if (isset($_POST['login'])&& isset($_POST['pass'])&& isset($_POST['pass2'])&& isset($_POST['email'])&& isset($_POST['name'])&& isset($_POST['city']))
            {$this->login = $this->CheckUserData($_POST['login']);
            $this->password = $this->CheckUserData($_POST['pass']);
            $this->password2 = $this->CheckUserData($_POST['pass2']);
            $this->email = $this->CheckUserData($_POST['email']);
            $this->name = $this->CheckUserData($_POST['name']);
            $this->city = $this->CheckUserData($_POST['city']);
        
            
            if ($this->login != '' && $this->password != ''&& $this->password2 != ''&& $this->email != ''&& $this->name != ''&& $this->city != ''){
                if ($this->loginExist($this->login) == TRUE){
                    if ($this->password == $this->password2){
                        if(!preg_match('/[^(\w)|(\x7F-\xFF)]/', $this->login)){      /////////!!!!!!!!!!!
                            $this->register();                                  //registration
                        }  else {
                            echo _('Login contains a special char');
                        }                        
                    }else echo _('Passwords do not match');
                }else    echo _('A username already exists');
            }else echo _('Not filled in all the fields');
        }else echo _('Not filled in all the fields');
        echo '</div>';
        echo _('<br /><a href="registration_form.php">Registration form</a>');
        
        echo '</div>';
    }
}

$page = new Registration();
Dataproc::lang();
$page->DisplayPage();

?>
