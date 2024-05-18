<?php include 'navbar.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
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
    <div class="home_header">
      <h1>
        <img
          src="https://www.seaton-sluice.co.uk/gallery_gen/7f73cafe40dc547184129c2e04ce77fb_958x110_0x0_967x110_crop.jpg?ts=1710774598"
          alt="Seaton Sluice and Old Hartley Local History Society">
      </h1>
    </div>

    <div class="main_body">
      <div class="login_box">
        <?php if (isset($_SESSION["error"])) {
          echo '<div class="error">' . $_SESSION['error'] . '</div>';
          unset($_SESSION['error']);
        }
        ?>
        <form action="login_process.php" method="post" name="login">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
          <br>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
          <br>
          <input type="submit" value="Login">
        </form>
        <form action="create_account.php">
          <input type="submit" value="Create Account">
        </form>
      </div>

    </div>

  </body>

</div>

</html>