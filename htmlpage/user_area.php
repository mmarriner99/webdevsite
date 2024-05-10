<?php include 'navbar.php';
if(session_status() == PHP_SESSION_NONE){
    session_start(); }
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="seaton_sluice.css">

<div class="body">

<head>
  <title>Seaton Sluice and Old Hartley Local History Society</title>
</head>

<body>
  <div class = "home_header">
  <h1>
      <img src="https://www.seaton-sluice.co.uk/gallery_gen/7f73cafe40dc547184129c2e04ce77fb_958x110_0x0_967x110_crop.jpg?ts=1710774598" alt="Seaton Sluice and Old Hartley Local History Society">
  </h1>
  </div>

<div class="main_body">
  <h2>Members Area</h2>
  <?php
  if(isset($_SESSION['new_account'])){
    echo '<p>Account successfully created</p>';
    unset($_SESSION['new_account']); // Sets flag for new account, removes it afterwards
  } elseif(isset($_SESSION['logged_in'])){
    echo '<p>Log in successful</p>';
    unset($_SESSION['logged_in']); // Unset logged_in session variable
  }
  ?>
  <div class="create_post">
  <form action="create_post.php" method="post" name="post">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title"><br>
    <label for="description">Description:</label><br>
    <textarea id="description" name="description"></textarea><br>
    <label for="date">Date:</label><br>
    <input type="date" id="date" name="date"><br>
    <label for="time">Time:</label><br>
    <input type="time" id="time" name="time"><br>
    <input type="submit" value="Create Event">
  </form>
  </div>
</div>

</body>

</div>

</html>
