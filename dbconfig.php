<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "teamnova", "teamnova", "teamnova");
if (!$conn) {
    echo "connection error : ";
    echo mysqli_connect_error();
    exit();
}
//else{
//    echo "good";
//}
mysqli_set_charset($conn, "UTF8");

?>