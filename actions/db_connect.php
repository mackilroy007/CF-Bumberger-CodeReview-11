<?php
// this will avoid mysql_connect() deprecation error.
error_reporting( ~E_DEPRECATED & ~E_NOTICE );


define ('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define ('DBNAME', 'cr11_bumberger_petadoption');

// create connection
$connect = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

// check connection
if($connect->connect_error){
    die("connection failed: ".$connect->connect_error);
} else {
    //  echo "Successfully Connected";
}

if  ( !$connect ) {
    die("Connection failed : " . mysqli_error());
   }

?>