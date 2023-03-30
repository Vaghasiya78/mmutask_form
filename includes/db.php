<?php

//connect database with some basic security
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "employee";

foreach($db as $key => $value){
define(strtoupper($key), $value);
}
//give values using array
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//check database is connecting or not
// if($connection){
//     echo "Connection succesfully";
// }

?>