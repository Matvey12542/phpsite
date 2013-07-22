<?php
require_once '../class/page_user.php';
require_once 'userdb.php';

class EditUser extends PageUser{
    
    public function AuthorizationUser()
    {
        parent::AuthorizationUser();
        
        if ((int)$_SESSION['role'] != 1)
        {
            $_SESSION['mess'] =  _('No permission');
            header("Location:../user/index.php");
            exit();
        }
        
    }
    
    public function Content() {
        echo '<div id="content">';
        
        //echo $_POST['role'];
        if (isset($_POST['role'])&&isset($_GET['id']))
        {
            $userdb = new UserDb();
            $userdb->replaceRole((int)$_GET['id'], (int)$_POST['role']);
            
            //var_dump( $_POST['role']);
            //echo $_GET['id'];
        } 
        
        $users = new UserDb();
        $allUser = $users->selectAllUser(); 
                       
        /*echo '<pre>';
        var_dump($allUser);
        echo '</pre>';*/
        
        echo '<table>';
        
        foreach ($allUser as $v)
        {
            echo "<tr><td>".$v['login']."</td> ";
            echo "<td><a href='?id={$v['id']}'>"._("DELETE").'</a> </td>';
            echo "<td>";
            /*switch ($v['role'])
            {
                case 1:
                    echo 'Administrator';
                    break;
                case 2:
                    echo 'Redaktor';
                    break;
                case 3:
                    echo 'User';
                    break;
                case 4:
                    echo 'Blocked';
                    break;
                default :
                    echo 'Non role';
                    
            }*/
         
?>    
            
            <form action="edituser.php?id=<?echo $v['id'];?>" method="post">
                <p><select name="role">
             <option <? if($v['role']== 0){echo 'selected';}?> value="0">non role</option>
             <option <? if($v['role']== 1){echo 'selected';}?> value="1">Admin</option>
             <option <? if($v['role']== 2){echo 'selected';}?> value="2">Redaktor</option>
             <option <? if($v['role']== 3){echo 'selected';}?> value="3">User</option>
             <option <? if($v['role']== 4){echo 'selected';}?> value="4">Blocked</option>
            </select>
            <input type="submit" value="Send"></p>
           </form>
<?
            echo "</td>";
            
            echo "</tr>";
            
        }
        
     echo '</table>';
            
        echo '</div>';
    }
    
}

$page = new EditUser();
$page->lang = Dataproc::lang();
$page->DisplayPage();
        

?>

