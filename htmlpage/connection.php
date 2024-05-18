<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Establish connection to daatabase
$host = '213.171.200.31';
$dbname = 'mmarriner';
$username = 'mmarriner';
$password = 'Password20*';
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
