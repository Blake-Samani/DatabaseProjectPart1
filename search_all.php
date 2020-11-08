<?
     
      $connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");

      $query = "select * from pageuser";
      $cursor = oci_parse ($connection, $query);
      if ($cursor == false){
          // For oci_parse errors, pass the connection handle
          $e = oci_error($connection);  
          die($e['message']);
       }
       $result = oci_execute ($cursor);
      if ($result == false){
      
      $e = oci_error($cursor);  
      die($e['message']);
      }

      // echo "<FORM name='Back' method='POST' action = 'adminpage.php?sessionid=$sessionid'>
      // <button type='submit' name='back' value='Back'> 
      // </FORM>"
    
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

