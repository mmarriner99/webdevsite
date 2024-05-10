<?php 
require 'connection.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    if (empty($title) || empty($description) || empty($date) || empty($time)) {
        $error = 'Fields cannot be left empty.';
    } else {
        $sql = "INSERT INTO events (user_id, title, description, date, time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $_SESSION['username'], $title, $description, $date, $time);
        $stmt->execute();
        header('Location: user_events.php');
        exit;
    }
}