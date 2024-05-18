<?php
require 'connection.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Get today's date
    $today = date("Y-m-d");

    if (empty($title) || empty($description) || empty($date) || empty($time)) {
        $_SESSION['error'] = "Fields cannot be empty";
        header("Location: user_area.php");
    } elseif ($date < $today) {
        $_SESSION['error'] = "Date cannot be before today's date";
        header("Location: user_area.php");
    } else {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];

        $sql = "INSERT INTO events (user_id, title, description, date, time) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $user_id, $title, $description, $date, $time);
        $stmt->execute();
        header('Location: user_events.php');
        exit;
    }
}