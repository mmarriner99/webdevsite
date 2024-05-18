<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment_id'])) {
        $comment_id = $_POST['comment_id'];
        $sql = "DELETE FROM comments WHERE comment_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $comment_id);
        if (!$stmt->execute()) {
            echo "Error executing SQL query: " . $stmt->error;
        } else {
            header("Location: user_events.php");
        }
    } else {
        echo "comment_id is not set in the POST request";
    }
}