<?php
include("connection.php");
//create an instance of Connection class
$connection = new connection();

//call the createDatabase methods to create database &quot;chap4Db&quot;
$connection->createDatabase('logininfo');

$query = "
CREATE TABLE client (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50) UNIQUE,
    password VARCHAR(80),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
";


//call the selectDatabase method to select the chap4Db
$connection->selectDatabase('logininfo');
$connection->createTable($query);


?>