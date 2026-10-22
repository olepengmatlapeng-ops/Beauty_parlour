
<?php

include "database.php";

$email = "John@gmail.com";
$password = password_hash("pass", PASSWORD_DEFAULT);
$name = "John";
$phone = "0728432559";

$stmt = $pdo->prepare(query: "INSERT INTO users (email, password, name, phone) VALUES (?, ?, ?, ?)");
$stmt->execute(params:[$email, $password, $name, $phone]);

echo "User created!";

?>

