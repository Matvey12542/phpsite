<?php
session_start();
function __autoload($class_name){
    require_once(strtolower("class/".$class_name).".php");
}

require_once 'lang.php';    //підключаєм настройку мови


$proced = false;
if (isset($_POST['register_form'])){
    $proced = true;
    
    $login = $_POST['login'];
    $password = $_POST['pass'];
    //$password2 = $_POST['pass2'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    
    $user = new Users();
    if(!($user->loginExist($login))){
        echo _("Such a user is already present. <br>");
        $proced = false;
    }
}

if ($proced===true){
    $user->login = $login;
    $user->password = $password;
    $user->email = $email;
    $user->name = $name;
    $user->city = $city;
    
    if ($user->register()) echo _("registration is successful");
}
// обробка даних форми
if (isset($_POST['login_form'])){
    $loginV = $_POST['user_login'];
    $passwordV = $_POST['user_pass'];
    //Вхід користувача
    if(Users::login($loginV,$passwordV)){
        echo _("<b> <font color=red> Login successful </font> </b>");
    }  else {
        echo _("<b> <font color=red> $loginV user not found or incorrect password </font> </b>");
    }
    
}
?>





<?php 
require_once 'block/header.php';
require_once 'block/header.php';
require_once 'block/left.php';
require_once 'block/content.php';
require_once 'block/footer.php';

?>

            
            
           

    
    
