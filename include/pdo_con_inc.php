<?php 
    // Lokal DB
    // $servername = "localhost";
    // $db_name = "ShareBNB";
    // $db_username = "sharebnb";
    // $db_password = "password";
    
    // Ekstern DB
    $servername = "mysql.stud.ntnu.no";
    $db_name = "toralfto_ShareBNB";
    $db_username = "toralfto_sharebnb";
    $db_password = "800nMoJX";
    
    // shareBNB.rocks DB
    // $servername = "localhost";
    // $db_name = "ShareBNB";
    // $db_username = "sharebnb";
    // $db_password = "nnS6m1G6FxaSpoG7yLMQGp";
    
    try {

        // Forsøker å logge inn til databasen
        $pdo = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);

    } catch (PDOException $e) {

        // Send error ved feil i databasetilkoblingen
        exit('Database connection error');

    }