<?php require 'connection.php'; 

// If a form is submitted this inserts the values into the database
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = $_POST['username']; 
  $password = $_POST['password'];

  // This is a prepared statement to prevent SQL injection
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // Inital attemtp to verify the password as a PHP hashed password, when new users create an account their plain text password is hashed
  $isPasswordCorrect = password_verify($password, $user['password']);

  // If that fails, compare the plain text password with the password stored in the database. This is for my initial entry into the database, will also likely serve as admin
  if(!$isPasswordCorrect){
    $isPasswordCorrect = $password == $user['password'];
  }

  if($user && $isPasswordCorrect){
    // User authenticated successfully
    // Redirect to the desired page
    // Set session variable to indicate user is logged in
    $_SESSION['username'] = $username;
    $_SESSION['logged_in'] = true;
    header('Location: user_area.php');
    exit;
  }else{
    // We use the /?error=1 to link to our PHP below, which will GET and print it if we have failed to login
    $_SESSION['error'] = "Invalid username or password";
    header("Location: login.php");
  }
}