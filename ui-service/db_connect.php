<?php

$servername = "db";
$username = "ranjit";
$password = "ranjit";
$db = "ranjit";

$conn = new mysqli('localhost','root','root','cms_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
