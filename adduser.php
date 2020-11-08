<?
    $clientid = $_POST["clientid"];
    $password = $_POST["passw"];
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $accounttype = $_POST["accttype"];

    $connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
    if ($connection == false){

    $e = oci_error(); 
    die($e['message']);
    }
    $query = "INSERT INTO pageuser (userid, passw, fname, lname, accttype) " .
            "VALUES ('$clientid', '$password', '$firstname', '$lastname', '$accounttype')";

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
    oci_commit ($connection);
    oci_free_statement($cursor);
    oci_close ($connection);
    Header("Location:adminpage.php?sessionid=$sessionid");
?>
