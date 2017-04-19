<?php
ob_start();

$db = array();
$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_password'] = '';
$db['db_name'] = 'cms';

//foreach:
foreach($db as $key => $value){

    // defined checking if constants are already defined
    // define to define constants
    // strtoupper to make the constants name from the key name
    defined(strtoupper($key))? null : define(strtoupper($key), $value);

}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//if ($connection){
//    echo 'success, we are connected';
//}