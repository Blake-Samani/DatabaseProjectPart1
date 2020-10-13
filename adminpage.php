<?

include "verifysession.php";

if($sessionid == "")
{
    echo("Invalid User");
}
else
{
    echo("Welcome to the Administrator Page");
}
?>