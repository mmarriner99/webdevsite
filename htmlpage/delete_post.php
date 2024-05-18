<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['event_id'])) {
        $event_id = $_POST['event_id'];
        $sql = "DELETE FROM events WHERE event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $event_id);
        if (!$stmt->execute()) {
            echo "Error executing SQL query: " . $stmt->error;
        } else {
            header("Location: my_events.php");
        }
    } else {
        echo "event_id is not set in the POST request";
    }
}