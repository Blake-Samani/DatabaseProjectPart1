<link rel="stylesheet" href="style.css">
<?
// include the verification PHP script
include "verifysession.php";
$sessionid = $_GET["sessionid"];

$connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
if($connection == false){
  $e = oci_error(); 
  die($e['message']);
}


echo"<div class='wrapper'>";
echo ("

        <FORM name='Change My Password' method='POST' action = 'changepassword.php?sessionid=$sessionid'>
            Update my password:
                <br><br>
                  
                    <input type='text' name='password' placeholder = 'New Password' required> 
                    <INPUT type='submit' name='submitpass' value='Change Password'></FORM>
        <br>
        <FORM name='Logout' method='POST' action = 'logout_action_proj.php?sessionid=$sessionid'> 
        LOGOUT
        <br>
        <INPUT type='submit' name='logout' value='Logout'></FORM>");


?>