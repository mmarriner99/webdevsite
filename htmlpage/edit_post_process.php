<?php
require 'connection.php';
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];

    $sql = "SELECT * FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $today = date("Y-m-d");

    if (empty($title) || empty($description) || empty($date) || empty($time)) {
        $_SESSION['error'] = "Fields cannot be empty";
        header("Location: edit_post.php?id=" . $event_id);
        exit();
    } elseif ($date < $today) {
        $_SESSION['error'] = "Date cannot be before today's date";
        header("Location: edit_post.php?id=" . $event_id);
        exit();
    } else {
        $sql = "UPDATE events SET title = ?, description = ?, date = ?, time = ? WHERE event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $description, $date, $time, $event_id);
        $stmt->execute();
        header("Location: my_events.php");
        exit();
    }
}