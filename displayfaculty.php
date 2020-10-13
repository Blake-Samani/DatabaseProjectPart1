<?
// setup connection with Oracle
$connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
if ($connection == false){
   // For oci_connect errors, no handle needed
   $e = oci_error(); 
   die($e['message']);
}

// this is the SQL command to be executed
$query = "select * from Faculty";
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
echo "<tr> <th>Name</th> <th>SSN</th> <th>Address</th>" . 
      "<th>Department</th> </tr>";

// fetch the result from the cursor one by one
while ($values = oci_fetch_array ($cursor)){
  $name = $values[0];
  $ssn = $values[1];
  $address = $values[2];
  $dept = $values[3];

  echo "<tr><td>$name</td> <td>$ssn</td> <td>$address</td>" .
        "<td>$dept</td> </tr>";
}

echo "</table>";

// free up resources used by the cursor
oci_free_statement($cursor);

// close the connection with oracle
oci_close ($connection);
?>

