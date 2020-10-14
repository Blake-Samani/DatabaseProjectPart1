<?
include "utility_functions_proj.php";

$sessionid =$_GET["sessionid"];
verify_session($sessionid);

$password = $_POST["password"];

$connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
if ($connection == false){
   // For oci_connect errors, no handle needed
   $e = oci_error(); 
   die($e['message']);
}
// connection OK - 
// $sql = "SELECT pageuser " .
//         "set passw = '$password' " .
//         "FROM " .
//         "pageuser JOIN clientsesh ON userid = clientid " .
//         "WHERE sessionid = '$sessionid'";

$query = "UPDATE p" .
"SET p.passw = '$password'" .
"FROM pageuser p" .
"JOIN clientsesh c ON c.clientid = p.userid" .
"WHERE sessionid = '$sessionid'" .

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
  $sessionid = $nuvalues[5];
  $clientid = $nuvalues[6];
  $date = $nuvalues[7];

  echo "<tr><td>$userid</td> <td>$passw</td> <td>$fname</td>" .
        "<td>$lname</td> <td>$accounttype</td> <td>$sessionid</td>  <td>$clientid</td> ".
        "<td>$date</td>  </tr>";
}

echo "</table>";

oci_free_statement($cursor);
oci_close ($connection);
?>