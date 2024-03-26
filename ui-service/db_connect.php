<?php

$servername = "db";
$username = "sai";
$password = "sai";
$db = "database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
