<?php
$dsn='mysql:dbname=phpkiso;host=localhost;charset=utf=8';
$user='root';
$password='';
$dbh = new PDO($dbn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMOODE,PDO::ERRMODE_EXCEPTION);

$username === $_POST['username'];
$email === $_POST['email'];
$password === $_POST['password'];

$sql='INSERT INTO users (username,email,password) VALUES ("'.$username.'","'.$email.'","'.$password.'")';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh=null;
?>