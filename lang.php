<?php 
/*Mova*/
// Цей файл не задіяний - а перенесений в dataproc

if (isset($_SESSION['lang']))
{
    $lang = addslashes($_SESSION['lang']);
    
}else{
    $lang = "ru";    
}

if (isset($_GET["lang"])){
    $lang= addslashes($_GET["lang"]);
    $_SESSION['lang']=$lang;
}

if ($lang == "en"){
    $locale = "en_US";
}
 else {
     $locale = "ru_RU.utf8";
}


putenv("LANG=$locale");
//putenv("LANG=en_US");
//setlocale(LC_ALL,"ru_RU.utf8");
setlocale(LC_ALL,$locale);

$domain = 'shop';

bindtextdomain($domain,"./locale");

textdomain($domain);

bind_textdomain_codeset($domain, 'UTF-8');
?>