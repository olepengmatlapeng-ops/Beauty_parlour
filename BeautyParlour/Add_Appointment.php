<?php

session_start();
include "database.php";

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty_Parlor</title>
</head>
<body>
    <u><h1>Add Appointment</h1></u>
    <form action="Add_Appointment.php" method="post">

    <label>Customer Name: </label>
    <input type="text" name="name" required>
    <br><br>

    <label>Style Name: </label>
    <input type="text" name="stylist" required>
    <br><br>

    <label>Status: </label>
    <select name="status">
        <option value="Booked">Booked</option>
    </select>
    <br><br>

    <label>Date: </label>
    <input type="date" name="date" required>
    <br><br>

    <label>Time: </label>
    <input type="time" name="time" required>
    <br><br>

    <button name="action">Add Appointment</button><br><br>

    <button><a href="dashboard.php">Dashboard</a></button><br>
    </form>
</body>
</html>
<?php 

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_SESSION['name'];
        $stylist = $_POST['stylist'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        if(empty($name)){
            echo 'Please enter the name field!';
        }
        elseif(empty($stylist)){
            echo 'Please enter the stylist field!';
        }
        elseif(empty($status)){
            echo 'Please enter the status field!';
        }
        elseif(empty($date)){
            echo 'Please enter the date field!';
        }
        elseif(empty($time)){
            echo 'Please enter the time field!';
        }
        else{
            try {

            $stmt = $pdo->prepare("INSERT INTO appointments (customer_name, stylist, status, date, time) VALUES(?,?,?,?,?)");
            $stmt->execute([$name, $stylist, $status, $date, $time]);
            echo"Appointment has been booked successfully!";
            } catch (PDOException) {
            echo"Invalid: Please try again!";   
            }
        }

    }
?>