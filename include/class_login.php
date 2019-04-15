<?php

    class Login {
        public function insert_new_user($firstname, $lastname, $email, $pwd) {
            global $pdo;
            $query = $pdo->prepare("INSERT INTO user (user_firstname, user_lastname, user_email, user_pwd) VALUES (?, ?, ?, ?)");
            $query->bindValue(1, $firstname);
            $query->bindValue(2, $lastname);
            $query->bindValue(3, $email);
            $query->bindValue(4, $pwd);
            $query->execute();
        }

        public function verify_existing_email($email) {
            global $pdo;
            $query = $pdo->prepare("SELECT COUNT('user_email') FROM user WHERE user_email = ?"); 
            $query->bindValue(1, $email);
            $query->execute(); 

            $number_of_rows = (int)$query->fetchColumn();
            
            if ($number_of_rows == 1) {
                return TRUE;
            } 
            return FALSE;
        }

        public function fetch_user_by_email($email) {
            global $pdo;
            $query = $pdo->prepare("SELECT * FROM user WHERE user_email = ?");
            $query->bindValue(1, $email);
            $query->execute();

            return $query->fetch();
        }


    }