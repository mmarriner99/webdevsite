<?php require 'connection.php';

// If a form is submitted this inserts the values into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // This is a prepared statement to prevent SQL injection
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // Verifies the password as a PHP hashed password, when new users create an account their plain text password is hashed
  $isPasswordCorrect = password_verify($password, $user['password']);

  if ($user && $isPasswordCorrect) {
    // User authenticated successfully
    // Redirect to the desired page
    // Set session variable to indicate user is logged in
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['logged_in'] = true;

    // Checks if user is an admin and assigns the session variable which allows for admin privileges
    if ($user['is_admin'] == 1) {
      $_SESSION['admin_welcome'] = true;
      $_SESSION['admin'] = true;
    }

    header('Location: user_events.php');
    exit;
  } else {
    // Prints an error message if the username or password is invalid
    $_SESSION['error'] = "Invalid username or password";
    header("Location: login.php");
  }
}