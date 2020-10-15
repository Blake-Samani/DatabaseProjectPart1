<?
 
 // setup connection with Oracle
 $connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
 if ($connection == false){
 // For oci_connect errors, no handle needed
 $e = oci_error(); 
 die($e['message']);
 }
 $sesh =$_GET["sessionid"];
 echo $sesh;



 // this is the SQL command to be executed



//  oci_commit ($connection);
 
 // close the connection with oracle
 oci_close ($connection);

//  Header("Location:loginproj.html"); 
?>