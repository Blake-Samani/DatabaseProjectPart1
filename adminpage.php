
<?



$sessionid = $_GET["sessionid"];


$connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
if($connection == false){
  $e = oci_error(); 
  die($e['message']);
}



echo ("<FORM name='Search' method='POST' action='search_all.php'> 
        List all users: 
        <INPUT type='submit' name='submit' value='Search'></FORM>
        
        <FORM name='Delete' method='POST' action = 'deleteuser.php'>
            Delete a User: <INPUT type ='text' name='clientid' required>
            <INPUT type='submit' name='delete' value='Delete'></FORM>
    
            <FORM name='Search User' method='POST' action='searchuser.php'> 
        Search a User ID: <INPUT type='text' name='clientid' > 
        <INPUT type='submit' name='submit' value='Search'></FORM>

        <FORM name='Reset a users password' method='POST' action='resetpassword.php'> 
        Reset Password: <INPUT type='text' name='clientid' placeholder='user id' required>  
        <INPUT type='submit' name='resetpassword' value='Reset Password'></FORM>

        <FORM name='Add User' method='POST' action= 'adduser.php'> 
        Add User: <INPUT type='text' name='clientid' placeholder='user id' required>
            <INPUT type='text' name='passw' placeholder='password' required> 
                <INPUT type='text' name='fname' placeholder='first name' required> 
                    <INPUT type='text' name='lname' placeholder='last name' required> 
                        <INPUT type='text' name='accttype'placeholder='account type' required> 
                             <INPUT type='submit' name='usersubmit' value='Add'></FORM>


        <FORM name='Update User' method='POST' action = 'search_update.php'> 
                Update User: <INPUT type='text' name='clientid' placeholder='user id' required>
                       <INPUT type='submit' name='userupdate' value='Update User'></FORM>

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