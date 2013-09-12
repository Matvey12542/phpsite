/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function validate_form ( )
{
	valid = true;
        var str = document.contact_form.login.value;
        if (/[a-zA-Z0-9]/.test(str))
        {
                alert ( "Спецсимволы не разрешены" );
                valid = false;
        }
        return valid;
}