<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<div class="navbar">
  <ul>
    <li><a href="homepage.php">Home</a></li>
    <li>
      <a href="the_harbour.php">The Harbour</a>
      <ul>
        <li><a href="coal.php">Coal</a></li>
        <li><a href="shipping.php">Shipping</a></li>
      </ul>
    </li>
    <li><a href="bottle_works.php">Bottle Works</a></li>
    <li>
      <a href="rocky_island.php">Rocky Island</a>
      <ul>
        <li><a href="housing.php">Early 20th Century - Housing</a></li>
        <li><a href="home_life.php">Early 20th Century - Home Life</a></li>
        <li><a href="families.php">Early 20th Century - Families</a></li>
      </ul>
    </li>
    <li>
      <a href="churches.php">Churches</a>
      <ul>
        <li><a href="church_of_our_lady.php">Church of our Lady</a></li>
        <li><a href="st_pauls.php">St. Paul's</a></li>
      </ul>
    </li>
    <li>
      <a href="seaton_delaval_hall.php">Seaton Delaval Hall</a>
      <ul>
        <li><a href="the_delavals.php">The Delavals</a></li>
        <li><a href="lord_hastings.php">Lord Hastings</a></li>
        <li><a href="notable_astleys.php">Notable Astleys</a></li>
      </ul>
    </li>
    <li><a href="the_watch_house.php">The Watch House</a></li>
    <li><a href="the_salt_pans.php">The Salt Pans</a></li>
    <li><a href="roberts_battery.php">Roberts Battery</a></li>
    <li><a href="seaton_sluice_today.php">Seaton Sluice Today</a></li>
    <li>
      <a href="images_of_old_seaton_sluice.php">Images of Old Seaton Sluice</a>
      <ul>
        <li><a href="images_pg_1.php">Page 1</a></li>
        <li><a href="images_pg_2.php">Page 2</a></li>
        <li><a href="images_pg_3.php">Page 3</a></li>
        <li><a href="images_pg_4.php">Page 4</a></li>
      </ul>
    </li>
    <li><a href="events.php">Events</a></li>
    <li><a href="contact_us.php">Contact Us</a></li>
    <li><a href="credits.php">About Us and Credits</a></li>
    <?php
    if (isset($_SESSION['username'])) {
      // User is logged in
      echo '<li><a href="user_area.php">Create Event</a></li>';
      echo '<li><a href="user_events.php">User Events</a></li>';
      echo '<li><a href="my_events.php">My Events</a></li>';
      echo '<li><a href="logout.php">Sign Out</a></li>';
    } else {
      // User is not logged in
      echo '<li><a href="login.php">Login</a></li>';
    }
    ?>
  </ul>
</div>