<?php

include 'db.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['message']);

$stmt = $conn->prepare("INSERT INTO contact(name,email,message) VALUES(?,?,?)");

$stmt->bind_param("sss",$name,$email,$message);

if($stmt->execute()){

echo "

<!DOCTYPE html>

<html>

<head>

<title>Success</title>

<style>

body{

font-family:Arial;

background:#f2f2f2;

display:flex;

justify-content:center;

align-items:center;

height:100vh;

}

.box{

background:white;

padding:40px;

border-radius:15px;

text-align:center;

box-shadow:0 10px 20px rgba(0,0,0,.2);

}

a{

display:inline-block;

margin-top:20px;

padding:10px 20px;

background:#0077ff;

color:white;

text-decoration:none;

border-radius:8px;

}

</style>

</head>

<body>

<div class='box'>

<h2>✅ Message Sent Successfully!</h2>

<p>Thank you for contacting us.</p>

<a href='index.html'>Go Back</a>

</div>

</body>

</html>

";

}else{

echo "Error : ".$stmt->error;

}

$stmt->close();

$conn->close();

}

?>