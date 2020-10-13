<?
$clientid = $_POST["clientid"];

$connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
if($connection == false){
  $e = oci_error(); 
  die($e['message']);
}

// connection OK - lookup the client
$sql = "select userid " .
      "from pageuser " .
      "where userid='$clientid'";
$cursor = oci_parse($connection, $sql);

if ($cursor == false) {
  $e = oci_error($connection);  
  echo $e['message']."<BR>";
  oci_close ($connection);
  // query failed - login impossible
  die("Client Query Failed");
}

// query is OK - If we have any rows in the result set, we have
// found the client
$result = oci_execute($cursor);
if ($result == false){
  $e = oci_error($cursor);  
  echo $e['message']."<BR>";
  oci_close($connection);
  die("Client Query Failed");
}

if(!$values = oci_fetch_array ($cursor)){
  oci_close ($connection);
  // client username not found
  die ("Client not found.");
}

oci_free_statement($cursor);

// found the client
$clientid = $values[0];

// create a new session for this visitor
$sessionid = md5(uniqid(rand()));

// store the link between the sessionid and the clientid
// and when the session started in the session table

$sql = "insert into clientsesh " .
  "(sessionid, clientid, sessiondate) " .
  "values ('$sessionid', '$clientid', sysdate)";

$cursor = oci_parse($connection, $sql);

if($cursor == false){
  $e = oci_error($connection);  
  echo $e['message']."<BR>";
  oci_close ($connection);
  // insert Failed
  die ("Failed to create a new session");
}

$result = oci_execute($cursor);
if ($result == false){
  $e = oci_error($cursor);
  echo $e['message']."<BR>";
  oci_close($connection);
  die("Failed to create a new session");
}

// insert OK - we have created a new session
//oci_commit ($connection);
// oci_close ($connection);



// ADDED
oci_free_statement($cursor);

// setup connection with Oracle
// $connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
// if ($connection == false){
//    // For oci_connect errors, no handle needed
//    $e = oci_error(); 
//    die($e['message']);
// }

// this is the SQL command to be executed
$query = "select accttype " .
      "from pageuser " .
      "where userid='$clientid'";
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
  // $userid = $nuvalues[0];
  // $passw = $nuvalues[1];
  // $fname = $nuvalues[2];
  // $lname = $nuvalues[3];
  $accounttype = $nuvalues[0];

  echo "<tr><td>$userid</td> <td>$passw</td> <td>$fname</td>" .
        "<td>$lname</td> <td>$accounttype</td> </tr>";
}

echo "</table>";

// free up resources used by the cursor
// oci_free_statement($cursor);
oci_free_statement($cursor);
// close the connection with oracle
oci_close ($connection);
// exists query
if($accounttype == 1){
  Header("Location:adminpage.php?sessionid=$sessionid");
}else if($accounttype == 0){
  Header("Location:studentpage.php?sessionid=$sessionid");
}

// Header("Location:welcomepage.php?sessionid=$sessionid");
?>

 
