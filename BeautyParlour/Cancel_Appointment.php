<?php 
include "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel Appointment</title>
</head>
<body>
    <h2>Cancel Appointment</h2>
    <br>
    <button><a href="View_Appointment.php">Back to Appointments</a></button>
     <br>
</body>
</html>
<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("UPDATE appointments SET status='cancelled' WHERE id=?");
        $stmt->execute([$id]);


        echo "<br>Appointment cancelled successfully!";
    } catch (PDOException) {
        echo "<br>Error cancelling appointment. Please try again.";
    }
} else {
    echo "<br>No appointment ID provided.";
}
?>
