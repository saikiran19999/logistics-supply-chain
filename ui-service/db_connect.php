<?php

$servername = "db";
$username = "edureka";
$password = "admin";
$db = "database";

$conn = new mysqli($servername,$username,$password,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
