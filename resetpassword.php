<?
        $clientid = $_POST["clientid"];


        $connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
        if ($connection == false){
        // For oci_connect errors, no handle needed
        $e = oci_error(); 
        die($e['message']);
        }

        // this is the SQL command to be executed
        $query = "UPDATE pageuser " .
                "set passw = 'default'" .
                "WHERE userid = '$clientid'";
                
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

        // close the connection with oracle
        oci_close ($connection);
        Header("Location:adminpage.php?sessionid=$sessionid");
?>
