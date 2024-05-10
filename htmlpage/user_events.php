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
  <div class = "home_header">
  <h1>
      <img src="https://www.seaton-sluice.co.uk/gallery_gen/7f73cafe40dc547184129c2e04ce77fb_958x110_0x0_967x110_crop.jpg?ts=1710774598" alt="Seaton Sluice and Old Hartley Local History Society">
  </h1>
  </div>

<div class="main_body">
  <h2>User Events</h2>

  <div class="create_post">
  <form action="" method="GET">
    <input type="text" name="title" placeholder="Search by title">
    <input type="date" name="date" placeholder="Search by date">
    <input type="submit" value="Search">
  </form>

  <?php
if (isset($_GET['title']) || isset($_GET['date'])) {
    $title = isset($_GET['title']) ? '%' . $_GET['title'] . '%' : '%';
    $date = isset($_GET['date']) ? $_GET['date'] : '';

    $sql = "SELECT * FROM events WHERE title LIKE ? OR date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $date);
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<h3>{$row['title']}</h3>";
        echo "<p>{$row['description']}</p>";
        echo "<p>{$row['date']} {$row['time']}</p>";
    }
} else {
    echo "<p>Please enter a title or date to search for events.</p>";
}
?>
  </div>
  </div>
</div>

</body>

</div>

</html>
