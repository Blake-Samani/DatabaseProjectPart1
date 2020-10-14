<?
$clientid = $_POST["clientid"];
$password = $_POST["passw"];
$firstname = $_POST["fname"];
$lastname = $_POST["lname"];
$accounttype = $_POST["accttype"];

// setup connection with Oracle
$connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
if ($connection == false){
   // For oci_connect errors, no handle needed
   $e = oci_error(); 
   die($e['message']);
}

// this is the SQL command to be executed
$query = "INSERT " .
        "INTO pageuser (userid, passw, fname, lname, accttype) " .
        "VALUES ($clientid, $password, $firstname, $lastname, $accounttype)";
        
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

oci_free_statement($cursor);

$query = "select * " .
        "from pageuser";

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

echo "</table>";

// free up resources used by the cursor
oci_free_statement($cursor);

// close the connection with oracle
oci_close ($connection);
?>
