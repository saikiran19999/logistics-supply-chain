<?php

$servername = "db";
$username = "ranjit";
$password = "ranjit";
$db = "cms_db";

$conn = new mysqli($servername,$username,$password,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
