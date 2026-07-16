<?php

$host = "localhost";
$username = "portfolio_user";
$password = "Password@123";
$database = "portfolio";

$conn = new mysqli($host, $username, $password, $database);

if($conn->connect_error){

die("Connection Failed: ".$conn->connect_error);

}

?>