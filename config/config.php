<?php

//host
$host = 'localhost';

//user
$user = 'root';

//password
$pass = '';

//database
$dbname = 'bookstore';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$secretKey = "sk_test_51P8OJSP736g8Fma57MgWy5uN4MYoWN0yYjGqHOvwkpnNomNehxfe5Fvzxc0DWeM5L03bRRSKnz3hsobzx0aG8Pwy00KFtnrNWH";

//if ($conn) {
//    echo 'connected';
//} else {
//    echo 'not connected';
//}