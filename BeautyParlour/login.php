<?php

    session_start();
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
    <h2>Beauty Parlor Login</h2>
    <form action="login.php" method="post">
        <label>Email: </label>
        <input type="email" name="email" placeholder="email@gmail.com" required><br><br>
        <label>Password: </label>
        <input type="password" name="password" required><br><br>
        <label> Remember Me: <input type="checkbox" name="remember"><label><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email)){
            echo "Please fill in the email field";
        }
        elseif(empty($password)){
            echo "Please fill in the password field";
        }
        else{
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row){
                if(password_verify($password, $row['password'])){
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];

            if(!empty($_POST['remember'])){
                setcookie("email", $email, time()+ 86400);
                setcookie("password", $password, time()+ 86400);
            }

            header("Location: dashboard.php");
            exit();
                }
                else{
                    echo "Invalid credentials.";
                }
            }else{
                echo "User not found";

            }
        }
    
    }
?>