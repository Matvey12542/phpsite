<?php
require_once 'db.php';

class UserOnline
{
    protected $_session = null;
    protected $_time = null;
    protected $_timeCheck = null;
    protected $userOnline = 0;
    protected $userAll = 0;
    protected $user = ' ';


    public function __construct() {
        if (session_id()==''){
            session_start();}
        $this->_session = session_id();
        $this->_time = time();
        $this->_timeCheck = time()-300;         // 5хв
        
        if (isset($_SESSION['login'])){
            $this->user = $_SESSION['login'];
            
        }else    $this->user = NULL;
        
        $this->logOnline();
    }
    
    private function logOnline(){
        $sql = "SELECT * FROM online WHERE session = :_session";  // Витягуєм сесію яка = теперішній сесії (ід)
        $stmt= db::getInstance()->prepare($sql);
        $stmt->bindValue(':_session',  $this->_session);
        $stmt->execute();
        $count  = $stmt->rowCount();
        
        
        if($count==0){                                // Перевіряєм чи така є?
            $sql = "INSERT INTO online (session,time,user) VALUES (:_session,:_time,:user)";   // Нема - вставляэм значення в базу
        } else {
            $sql = "UPDATE online SET time=:_time, user=:user WHERE session= :_session";        //Є - обновляєм час сесії (ід)
        }
        $stmt= db::getInstance()->prepare($sql);
        $stmt->bindValue(':_session',  $this->_session);
        $stmt->bindValue(':_time',  $this->_time);
        $stmt->bindValue(':user',  $this->user);
        $stmt->execute();                                       // Виконуєм запрос..
        
        // Витягуєм всі записи і рахуєм
        
        $sql = "SELECT * FROM online";          
        $stmt= db::getInstance()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->userAll = $stmt->rowCount();
        
        if ($this->userAll > 0){
            foreach ($result as $result){
                if(!empty($result['user'])){
                    //if (!$result['user'] == 'unreg')
                    $this->userOnline++;
                }
            }
        }
        
        // Видаляєм устарівші записи
        $sql = "DELETE FROM online WHERE time < :time";
        $stmt= db::getInstance()->prepare($sql);
        $stmt->bindValue(':time',  $this->_timeCheck);
        $stmt->execute();       
    }
    
    public function getOnline(){
        return $this->userOnline;
    }
    public function getAll(){
        return $this->userAll;
    }
}

//$Counter = new UserOnline();
//echo 'User online- '. $Counter->getOnline();

?>
