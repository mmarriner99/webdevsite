<?php include 'navbar.php';
include 'edit_post_process.php';
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
      <h2>Edit Post</h2>
      <div class="create_post">
        <?php if (isset($_SESSION["error"])) {
          echo '<div class="error">' . $_SESSION['error'] . '</div>';
          unset($_SESSION['error']);
        }
        ?>
        <form method="post">
          <label for="title">Title:</label><br>
          <input type="text" id="title" name="title" value="<?php echo $event['title']; ?>"><br>
          <label for="description">Description:</label><br>
          <textarea id="description" name="description"><?php echo $event['description']; ?></textarea><br>
          <label for="date">Date:</label><br>
          <input type="date" id="date" name="date" value="<?php echo $event['date']; ?>"><br>
          <label for="time">Time:</label><br>
          <select id="time" name="time">
            <?php
            for ($hours = 0; $hours < 24; $hours++) {
              for ($mins = 0; $mins < 60; $mins += 15) {
                $time = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
                $selected = ($time == $event['time']) ? 'selected' : '';
                echo "<option value='{$time}' {$selected}>{$time}</option>";
              }
            }
            ?>
          </select>
          <br>
          <input type="submit" value="Update">
        </form>
      </div>
    </div>
</div>

</body>

</div>

</html>