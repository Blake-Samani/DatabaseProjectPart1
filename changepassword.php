<?
//password not changing, unsure why


$sessionid=$_GET["sessionid"];
$newpassword=$_POST["password"];


// verify_session($sessionid);

$connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
if ($connection == false){
   $e = oci_error(); 
   die($e['message']);
}

$query = "SELECT userid FROM pageuser INNER JOIN clientsesh ON userid=clientid WHERE sessionid='$sessionid'";


$cursor = oci_parse ($connection, $query);
if ($cursor == false){
           
$e = oci_error($connection);  
die($e['message']);
}

$result = oci_execute ($cursor);
if ($result == false){
   // For oci_execute errors pass the cursor handle
   $e = oci_error($cursor);  
   die($e['message']);
}

echo "<table border=1>";
echo "<tr> <th>userid</th> </tr>";
          
          // fetch the result from the cursor one by one
          while ($nuvalues = oci_fetch_array ($cursor)){
          
            $clientid = $nuvalues[0];
          
            echo "<tr><td>$clientid</td> </tr>";
          }
          
echo "</table>";
          
oci_free_statement($cursor);

$sql = "UPDATE pageuser SET passw = '$newpassword' WHERE userid ='$clientid'";


$cursor = oci_parse ($connection, $sql);
if ($cursor == false){
           
$e = oci_error($connection);  
die($e['message']);
}

$result = oci_execute ($cursor);
if ($result == false){
   // For oci_execute errors pass the cursor handle
   $e = oci_error($cursor);  
   die($e['message']);
}



oci_free_statement($cursor);
oci_close ($connection);
Header("Location:adminpage.php?sessionid=$sessionid");
?>