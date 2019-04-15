<?php

    class Signup {
        public function insert_new_user($firstname, $lastname, $email, $pwd) {
            global $pdo;
            $query = $pdo->prepare("INSERT INTO user (user_firstname, user_lastname, user_email, user_pwd, user_registration_time) VALUES (?, ?, ?, ?, ?)");
            $query->bindValue(1, $firstname);
            $query->bindValue(2, $lastname);
            $query->bindValue(3, $email);
            $query->bindValue(4, $pwd);
            $query->bindValue(5, time());
            $query->execute();
        }

        public function check_available_email($email) {
            global $pdo;
            $query = $pdo->prepare("SELECT COUNT('user_email') FROM user WHERE user_email = ?"); 
            $query->bindValue(1, $email);
            $query->execute(); 

            $number_of_rows = (int)$query->fetchColumn();
            
            if ($number_of_rows == 0) {
                
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

        public function update_user($firstname, $lastname, $email, $pwd, $userID){
            global $pdo;
            $query = $pdo->prepare("UPDATE user SET user_firstname = ?, user_lastname = ?, user_email = ?, user_pwd = ?  WHERE user_ID = ?");
            $query->bindValue(1, $firstname);
            $query->bindValue(2, $lastname);
            $query->bindValue(3, $email);
            $query->bindValue(4, $pwd);
            $query->bindValue(5, $userID);
            $query->execute();            
        }

        public function delete_user($userID){
            global $pdo;
            $query = $pdo->prepare("DELETE FROM user WHERE user_ID = ?");
            $query->bindValue(1, $userID);
            $query->execute();            
        }
    }