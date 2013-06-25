<?php

//echo 'privet';
$server = "localhost";
$username = "kolya";
$passwd = "751392";
$dbname = "test";




// підключення до бази даних
$db = new PDO('mysql:host=localhost;dbname=test', $username, $passwd);

// вибірка
$sql = "SELECT * FROM param";
$result = $db->query($sql);     // mysql_query()....
// Вивід записів
echo "<h1>Виводим всі записи через цикл відразу </h1>";
while ($articles = $result->fetch(PDO::FETCH_ASSOC)){   //mysql_fetch_assoc(..)
    echo "{$articles['id']} Text: {$articles['text']}. <br />";
}

// Всі записи з бд в масив
$sql = "SELECT * FROM param";
$result = $db->query($sql);
$articles = $result->fetchAll(PDO::FETCH_ASSOC);    // Заносим в артіклес всі записи в вигляді масиву

echo "<h1>Виводим всі записи з масиву </h1>";
foreach ($articles as $articles){
    echo "{$articles['id']} Text:{$articles['text']}. <br />";
}

// вибірка за допомогою змінних
$sql = "SELECT * FROM param";
$result = $db->query($sql);
$result->bindColumn('id', $id);
$result->bindColumn('text',$text);

echo "<h1>Вивід даних з привязкою до змінних</h1>";

while($result->fetch(PDO::FETCH_ASSOC)){
echo "{$id} Text: {$text} <br />";    
}
//----------------------------------------------------

$username = "Kolya";
$password = "12345"; // "' OR '1'='1";

$sql = "SELECT * FROM users WHERE name = :name AND password = :password LIMIT 1";
$result = $db->prepare($sql);

echo "<h1>Вивод через фильтрацию PDO</h1>";

$result->bindValue(':name',$username);
$result->bindValue(':password', $password);
$result->execute();

$result->bindColumn('id', $id);
$result->bindColumn('name',$name);
$result->bindColumn('password', $password);
$result->fetch();

echo "{$id} name - {$name} passwd- {$password}";



/*
class User{
    public $login;
    public $pass;
    
    public function __construct($login,$pass) {
        echo 'object create ;)<br>';
        $this->login = $login;
        $this->pass = $pass;
    }
    public function showInfo(){
        echo 'Login: '.$this->login.'<br>';
        echo 'Password: '.$this->pass.'<br>';
        echo __METHOD__.' '.__CLASS__;
    }
    public function __clone (){
        $this->login = 'Tolik';
        $this->pass = '777';
    }
}

class Car{
    public $speed=0;
    function printSpeed(){
        echo $this->speed;
    }
}


class Toyota extends Car{
    public $country = 'Japan';
    function printCountry(){
        echo $this->country;
    }
}

$car1 = new Toyota;
$car1->printCountry();
echo '<br>';
$car1->printSpeed()
*/
?>