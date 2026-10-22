<?php
include "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty_Parlor</title>
</head>
<body>
    <u><h1>View Appointments</h1></u>
    <form action="View_Appointment" method="post">
        <button><a href="dashboard.php">Dashboard</a></button><br><br>
    </form>
</body>
</html>
<?php

    try{
        $stmt =$pdo->query("SELECT id, customer_name, style, status, date, time FROM appointments");
        

        if($stmt->rowCount() >0){
        echo"<table border = '1'>
        <tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Style</th>
            <th>Status</th>
            <th>Date</th>
            <th>Time</th>
            <th>Update</th>
            <th>Cancel</th>
        </tr>";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo"<tr>
                    <td>{$row['id']}</td>
                    <td>".htmlentities($row['customer_name'])."</td>
                    <td>".htmlentities($row['style'])."</td>
                    <td>".htmlentities($row['status'])."</td>
                    <td>".htmlentities($row['date'])."</td>
                    <td>".htmlentities($row['time'])."</td>
                    <td><a href='update_appointment.php?id={$row['id']}'>Update</a></td> 
                    <td><a href='cancel_appointment.php?id={$row['id']}'>Cancel</a></td>
                    </td>
                </tr>";
        }
        echo "</table>";
    }
    else{
        echo "No Appointments found!";
    }
 } catch(PDOException){
    echo "Error: Please try again.";
 }
?>
