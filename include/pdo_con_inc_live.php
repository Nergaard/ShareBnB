<?php 
    // shareBNB.rocks DB
    $servername = "localhost";
    $db_name = "ShareBNB";
    $db_username = "sharebnb";
    $db_password = "nnS6m1G6FxaSpoG7yLMQGp";
    
    try {

        // Forsøker å logge inn til databasen
        $pdo = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);

    } catch (PDOException $e) {

        // Send error ved feil i databasetilkoblingen
        exit('Database connection error');

    }