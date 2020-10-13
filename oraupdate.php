<?
putenv("ORACLE_HOME=/u01/app/oracle/product/11.2.0/dbhome_1");
putenv("ORACLE_SID=orcl");

$connection = oci_connect ("gq008", "mjbrwe", "gqiannew2:1521/pdborcl");
if ($connection == false) {
	$e = oci_error();
	die($e['message']);
}

$query="insert into faculty(facname, facssno, officeaddress, worksfor) ".
	"values ('Mike', '000000010', 'Engineering Building', 'EE')";

$cursor = oci_parse ($connection, $query);
if ($cursor == false) {
	$e = oci_error($connection);
	die($e['message']);
}

$result = oci_execute ($cursor, OCI_NO_AUTO_COMMIT);
if ($result == false){
	$e = oci_error($cursor);
	die($e['message']);
}

oci_commit($connection);

oci_close($connection);

echo ("Record inserted.");
?>
