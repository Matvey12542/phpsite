<?php
function __autoload($class_name){
    require_once ("class/".strtolower($class_name).".php");
}

class index extends Page_public{
    
    public $lang = 'ru';
    
    public function __constract() {
        //session_start();
    }
    

    public function Content()
    {
        
        echo '<div id="content">'; 
        echo '<h1 id="h1news">'._('News').'</h1>';
        /*$this->ShowAvatar();*/
        $this->ShowNews($this->lang);
                          
                            
        echo '</div>';
        
    }
    public function Left()
    {
        ?>
        <div id="nav">
                <ul>
                    <li><a href="user/index.php"><?echo _("Administration")?></a> </li>
                    <li><a href="registration_form.php"><?echo _("Registration_form")?></a> </li>
                    
                </ul>
                <?  
                    if (isset($_SESSION['mess']))
                    {
                        echo "<br>".$_SESSION['mess'];
                        unset($_SESSION['mess']);
                    } 
                
                    //$this->ShowLoginForm();
                
                    echo '<p>';
                    $Counter = new UserOnline();
                    echo _('User online- '). $Counter->getOnline().'<br>';
                    echo _('All User- ').$Counter->getAll().'<br>';
                    echo '</p>';
                ?>
            
       </div>
                    
        <?php
    }
 
    public function ShowNews($lang){
        $news = new NewsDb();
        $result = $news->Select($lang);
		
		
        foreach ($result as $res){
			$res['news_date'] = substr($res['news_date'], 0, 10);
                        $res['news_text'] = $this->obrezka($res['news_text']);
            printf("<table class='news'><tr class='news_head'><td><p class='title'><a href='newsview.php?id=%s&lang=%s'>%s</a></p>\n
                    <p class='date'>%s</p></td></tr> <tr class='news_body'><td><p>%s</p></td></tr></table>"
                    ,$res['news_id'],$this->lang,$res['news_title'],$res['news_date'],$res['news_text']);
            echo "<p class='read_more'><a href='newsview.php?id=".$res['news_id']."&lang=".$this->lang."'>"._("Read more")."</a></p>";
        }
    }
    public function obrezka($str){
        
        if(strlen($str) <= 150) return $str
                ;
        $res =  mb_substr($str,0, 150,'UTF-8');        //ріжем від 0 до 150
        $res =  mb_substr($res, 0, strrpos($res, ' ' ),'UTF-8');
       
        if ($res == $str)
            return $res;
        return $res." ...";
    }
    
}

$page = new index();
$page->lang = Dataproc::lang();
$page->DisplayPage();




?>
