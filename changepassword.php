<?
include "utility_functions_proj.php";

$sessionid = $_GET["sessionid"];
$clientid = $_GET["clientid"];
verify_session($sessionid);

$password = $_GET["password"];

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

$query = "UPDATE pageuser" .
            "SET passw = '$password'" .
            "WHERE userid = '$clientid'";

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


oci_free_statement($cursor);
oci_close ($connection);
?>