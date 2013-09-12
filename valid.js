/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


document.getElementById('log').onkeypress = function(event){
    var keycode;
    if(!event)  var event = window.event;
    else if(event.which) keycode = event.which; // all browsers
//    if(keycode < 49){
        this.value = this.value.replace(/[^(\w)|(\x7F-\xFF)]/, '');
//    }
    
    //alert("keycode: "+keycode);
    
 }