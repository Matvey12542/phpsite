<?php
require_once ('class/page_public.php');

class Registration_form extends Page_public{
    public function Content()
    {   
        echo '<div id="content">';
        echo '<script src="validate.js"></script>';
       ?>
       
       <table align="center" border="0">
       <tr>
         <td align="center">
           <h3><?echo _("User registration")?></h3>
         </td>
       </tr>
       <tr>
         <td>
           <h3><?php $this->ShowRegistrationForm(); ?></h3>
         </td>
       </tr>
       </table>
       <?php
        echo '</div>';
    }
    
    public function ShowRegistrationForm()
    {   
        echo "<h3>"._('Registration')."</h3>";
        
        
                        ?>
                        <form name="contact_form" action="registration.php" method="post" onsubmit="return validate_form();">
                            <table>
                                <tr><td><?echo _('login:')?></td><td><input id="log" type="text" name="login"></td></tr>
                                <tr><td><?echo _('Password:')?></td><td><input type="password" name="pass"></td></tr>
                                <tr><td><?echo _('Password_repeat:')?></td><td><input type="password" name="pass2"></td></tr>
                                <tr><td><?echo _('Email:')?></td><td><input type="text" name="email"></td></tr>
                                <tr><td><?echo _('Name:')?></td><td><input type="text" name="name"></td></tr>
                                <tr><td><?echo _('City:')?></td><td><input type="text" name="city"></td></tr>
                                <tr><td>&nbsp;</td><td><input type="submit" value="<?echo _('Registration:')?>" name="register_form"></td></tr>
                            </table>
                        </form>      
                        <?
                        echo '<script src="valid.js"></script>';
    }
}
$page = new Registration_form();
Dataproc::lang();
$page->DisplayPage();

?>
