<?php

$hostname = 'ranjit'; // This should be the name of the MySQL service defined in your Docker Compose file
$username = 'ranjit'; // MySQL username
$password = 'ranjit'; // MySQL password
$database = 'ranjit'; // MySQL database name

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
