<?php

        //CREATING DATABASE
try {
    
    $pdo = new PDO(
        "mysql:host=localhost;
        dbname=beauty_parlourdb",
        "root",
        "password");

    echo "✅ The Database is online!<br>";

} catch (PDOException $e) {
   
    echo "❌ Connection failed:";
}
?>