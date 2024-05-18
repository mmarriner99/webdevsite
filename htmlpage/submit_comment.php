<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'connection.php';

$event_id = $_POST['event_id'];
$comment = $_POST['comment'];
$user_id = $_SESSION['user_id'];

if (empty($comment)) {
    $_SESSION['error'] = "Comment cannot be empty";
    header("Location: user_events.php");
    exit();
}

$stmt = $conn->prepare("INSERT INTO comments (user_id, event_id, comment) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $user_id, $event_id, $comment);

$stmt->execute();

header("Location: user_events.php");