<?
 $clientid = $_POST["clientid"];
 $connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");

 if ($connection == false){

 $e = oci_error(); 
 die($e['message']);
 }

 $query = "delete " .
 "from pageuser " .
 "where userid='$clientid' ";

 $cursor = oci_parse ($connection, $query);
 if ($cursor == false){

  $e = oci_error($connection);  
 die($e['message']);
 }

 $result = oci_execute ($cursor);
 if ($result == false){

  $e = oci_error($cursor);  
 die($e['message']);
 }

 oci_free_statement($cursor);
 oci_close ($connection);

 Header("Location:adminpage.php");
?>
