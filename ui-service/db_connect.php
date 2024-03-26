<?php

$servername = "db";
$username = "ranjit";
$password = "ranjit";
$db = "myDb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
