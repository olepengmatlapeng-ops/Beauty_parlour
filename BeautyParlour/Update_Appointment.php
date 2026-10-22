<?php
session_start();
include "database.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $pdo->prepare("SELECT * FROM appointments WHERE id=?");
    $stmt->execute([$id]);
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$appointment) {
        echo "Appointment not found.";
        exit();
    }

  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['customer_name'];
        $style = $_POST['style'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        try {
            $stmt = $pdo->prepare("UPDATE appointments SET customer_name=?, style=?, date=?, time=? WHERE id=?");
            $stmt->execute([$name, $style, $date, $time, $id]);

            echo "Appointment updated successfully!";
        } catch (PDOException ) {
            echo "Error updating appointment. Please try again.";
        }
    }
} else {
    echo "No appointment ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Appointment</title>
</head>
<body>
    <h2>Update Appointment</h2>
    <form method="post">
        <label>Customer Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($appointment['customer_name']) ?>" required><br><br>

        <label>Style:</label>
        <input type="text" name="style" value="<?= htmlspecialchars($appointment['style']) ?>" required><br><br>

        <label>Date:</label>
        <input type="date" name="date" value="<?= htmlspecialchars($appointment['date']) ?>" required><br><br>

        <label>Time:</label>
        <input type="time" name="time" value="<?= htmlspecialchars($appointment['time']) ?>" required><br><br>

        <button type="submit">Update Appointment</button>
    </form>

    <br>
    <button><a href="View_Appointment.php">Back to Appointments</a></button>
</body>
</html>
