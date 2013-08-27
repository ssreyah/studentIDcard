<?php
include("data.php");
function connectDB(){
   $dsn = $DatabaseType.":host=".$DatabaseServer.";dbname=".$DatabaseName;
   $dbh = new PDO($dsn, "$DatabaseUsername", "$DatabasePassword");
   return $dbh;
}
?>
