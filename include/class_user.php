<?php

    class User {
        // Denne funksjon er for table.php
        public function getInfoFromDB($approvedByUser) {
            global $pdo;
            $query = $pdo->prepare("SELECT rental_ID, rental_rented_by, rental_time_from, rental_time_to, rental_residence_ID
            FROM rental
            WHERE rental_approved_by = ?");
            $query->bindValue(1, $approvedByUser);
            $query->execute();
            return $query->fetchAll();
        }
        
        // Denne funksjon er for table.php
        public function getInfoFromDBv3($residence_admin) {
            global $pdo;
            $query = $pdo->prepare("SELECT rental_ID, rental_rented_by, rental_time_from, rental_time_to, rental_residence_ID, rental_approved_by, rental_approved_by_user, rental_contract, rental_admin_ID
                                    FROM rental
                                    WHERE rental_admin_ID = ?");
            $query->bindValue(1, $residence_admin);
            $query->execute();
            return $query->fetchAll();
        }
        // Denne funksjon er for table.php
        public function getInfoFromDB_by_renter($residence_admin) {
            global $pdo;
            $query = $pdo->prepare("SELECT rental_ID, rental_rented_by, rental_time_from, rental_time_to, rental_residence_ID, rental_approved_by, rental_approved_by_user, rental_contract, rental_admin_ID
                                    FROM rental
                                    WHERE rental_rented_by = ?");
            $query->bindValue(1, $residence_admin);
            $query->execute();
            return $query->fetchAll();
        }
        
        // Denne funksjon er for tableToAp.php
        public function getInfoFromDB2($rental_residence_ID) {
            global $pdo;
            $query = $pdo->prepare("SELECT rental_rented_by, rental_time_from,rental_time_to
            FROM rental
            WHERE rental_residence_ID = ?");
            $query->bindValue(1, $rental_residence_ID);
            $query->execute();
            return $query->fetchAll();
        }

        public function getRentersEmail($rentersID) {
            global $pdo;
            $query = $pdo->prepare("SELECT user_email FROM user WHERE user_ID = ?");
            $query->bindValue(1, $rentersID);
            $query->execute();
            return $query->fetch();
        }

        public function getRentedAddress($resID) {
            global $pdo;
            $query = $pdo->prepare("SELECT residence_address FROM residence WHERE residence_ID = ?");
            $query->bindValue(1, $resID);
            $query->execute();
            return $query->fetch()[0];
        }

        public function fetch_user_by_id($u_id) {
            global $pdo;
            $query = $pdo->prepare("SELECT * FROM user WHERE user_ID = ?");
            $query->bindValue(1, $u_id);
            $query->execute();
            return $query->fetch();
        }

        public function verify_email_exist($email) {
            global $pdo;
            $query = $pdo->prepare("SELECT COUNT('user_email') FROM user WHERE user_email = ?"); 
            $query->bindValue(1, $email);
            $query->execute(); 

            $number_of_rows = (int)$query->fetchColumn();
            if ($number_of_rows == 0) {
                
                return FALSE;
            } 
            return TRUE;
        }

    }