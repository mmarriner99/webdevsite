<?php
require 'connection.php'; 

// If a form is submitted this inserts the values into the database
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = $_POST['username']; 
  $password = $_POST['password'];

  // Check if the username already exists
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows > 0){
    // Username already exists
    // Store error message in session
    $_SESSION['error'] = "Username already exists";
    header("Location: create_account.php");
    exit;
  }

  // Hashes the password for added layer of security
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // This is a prepared statement to prevent SQL injection
  $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  $stmt->bind_param("ss", $username, $hashed_password);
  $stmt->execute();

  if($stmt->affected_rows === 1){
    // User registered successfully
    // Set new account variable as true
    // Redirect to the user_area page
    $_SESSION['username'] = $username;
    $_SESSION['logged_in'] = true;
    header('Location: user_area.php');
    exit;
  }else{
    // Registration failed
    // Redirect back to the registration page with an error message
    $_SESSION['error'] = "Registration failed";
    header("Location: create_account.php");
  }
}