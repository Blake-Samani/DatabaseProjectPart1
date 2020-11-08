<?

 $sessionid = $_GET["sessionid"];
 

 $connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
 if ($connection == false){

 $e = oci_error(); 
 die($e['message']);
 }
 

 $sql = "DELETE FROM clientsesh WHERE sessionid='$sessionid'";

      $cursor = oci_parse ($connection, $sql);
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
 Header("Location:loginproj.html"); 
?>