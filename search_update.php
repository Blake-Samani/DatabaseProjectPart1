<?
$clientid = $_POST["clientid"];

// setup connection with Oracle
$connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
if ($connection == false){
   // For oci_connect errors, no handle needed
   $e = oci_error(); 
   die($e['message']);
}

// this is the SQL command to be executed
$query = "select * " .
        "from pageuser " .
        "where userid='$clientid' ";
        
// parse the SQL command
$cursor = oci_parse ($connection, $query);
if ($cursor == false){
   // For oci_parse errors, pass the connection handle
   $e = oci_error($connection);  
   die($e['message']);
}

// execute the command
$result = oci_execute ($cursor);
if ($result == false){
   // For oci_execute errors pass the cursor handle
   $e = oci_error($cursor);  
   die($e['message']);
}

// display the results
echo "<table border=1>";
echo "<tr> <th>userid</th> <th>passw</th> <th>fname</th>" . 
      "<th>lname</th> <th>accounttype</th> </tr>";

// fetch the result from the cursor one by one
while ($nuvalues = oci_fetch_array ($cursor)){
  $userid = $nuvalues[0];
  $passw = $nuvalues[1];
  $fname = $nuvalues[2];
  $lname = $nuvalues[3];
  $accounttype = $nuvalues[4];

  echo "<tr><td>$userid</td> <td>$passw</td> <td>$fname</td>" .
        "<td>$lname</td> <td>$accounttype</td> </tr>";
}

echo ("</table>
<br>
<br>
<FORM name='Update User' method='POST' action ='search_update_action.php'> 
Update User: <INPUT type='text' name='clientid' placeholder='user id' required>
<br>
<br>
Type the same user information if you dont want to change a field:
    <br>
    <br>
    <INPUT type='text' name='newid' placeholder='New User ID' required>
    <INPUT type='text' name='passw' placeholder='password' required>
        <INPUT type='text' name='fname' placeholder='first name' required> 
            <INPUT type='text' name='lname' placeholder='last name' required> 
                <INPUT type='text' name='accttype'placeholder='account type' required> 
                     <INPUT type='submit' name='userupdate' value='Update'></FORM>
");

// free up resources used by the cursor
oci_free_statement($cursor);

// close the connection with oracle
oci_close ($connection);
?>
