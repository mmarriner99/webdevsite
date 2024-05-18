<?php include 'navbar.php';
require 'connection.php';
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
      <h2>User Events</h2>
      <?php
      if (isset($_SESSION['new_account'])) {
        echo '<p>Account successfully created. Welcome!</p>';
        unset($_SESSION['new_account']); // Sets flag for new account, removes it afterwards
      } elseif (isset($_SESSION['admin_welcome'])) {
        echo '<p>*** THIS ACCOUNT HAS ADMIN PRIVILEGES ***</p>';
        unset($_SESSION['admin_welcome']); // Displays a message if the user is an admin 
      } elseif (isset($_SESSION['logged_in'])) {
        echo '<p>Logged in. Welcome back!</p>';
        unset($_SESSION['logged_in']); // Same principle for an existing user 
      }


      ?>

      <div class="create_post">
        <form action="" method="GET">
          <input type="text" name="title" placeholder="Search by title">
          <input type="date" name="start_date" placeholder="Search from this date">
          <input type="date" name="end_date" placeholder="Search to this date">
          <input type="submit" value="Search">
        </form>

        <?php
        if (isset($_GET['title']) || (isset($_GET['start_date']) && isset($_GET['end_date']))) {
          $title = isset($_GET['title']) ? '%' . $_GET['title'] . '%' : '%';
          $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '1970-01-01';
          $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '9999-12-31';

          $sql = "SELECT * FROM events WHERE title LIKE ? AND (date >= ? AND date <= ?)";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("sss", $title, $start_date, $end_date);
        } else {
          $sql = "SELECT * FROM events";
          $stmt = $conn->prepare($sql);
        }

        $stmt->execute();
        $result = $stmt->get_result();


        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<h3>{$row['title']}</h3>";
            echo "<p>{$row['description']}</p>";
            $date = date('d/m/Y', strtotime($row['date']));
            $time = date('H:i', strtotime($row['time']));
            echo "<p>{$date} {$time}</p>";

            $comments_sql = "SELECT * FROM comments WHERE event_id = ?";
            $comments_stmt = $conn->prepare($comments_sql);
            $comments_stmt->bind_param("i", $row['event_id']);
            $comments_stmt->execute();

            $comments_result = $comments_stmt->get_result();
            while ($comment = $comments_result->fetch_assoc()) {
              echo $comment['comment'];

              // Checks if the current user is the author of the comment or an admin, and displays a delete button
              if ($_SESSION['user_id'] == $comment['user_id'] || $_SESSION['admin'] == true) {
                echo '<form action="delete_comment.php" method="post">';
                echo '<input type="hidden" name="comment_id" value="' . $comment['comment_id'] . '">';
                echo '<input type="submit" value="Delete">';
                echo '</form>';
              }
            }

            // Add a comment form for each event
            echo '<form action="submit_comment.php" method="post">';
            echo '<input type="hidden" name="event_id" value="' . $row['event_id'] . '">';
            echo '<textarea name="comment" placeholder="Leave a comment"></textarea>';
            echo '<input type="submit" value="Submit Comment">';
            echo '</form>';
          }
        } else {
          echo "<p>Please enter a title or date to search for events.</p>";
        }
        ?>
      </div>
    </div>
</div>

</body>