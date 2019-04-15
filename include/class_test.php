<?php

    class Test {
        public function start($headline) {
            echo '<tr>';
                echo '<td>';
                    echo $headline;
                echo '</td>';
        }

        public function end() {
            echo '</tr>';
        }

        public function response_ok($response) {
            echo '<td class="ok">';
                    echo $response;
            echo '</td>';
        }

        public function response_error($response) {
            echo '<td class="error">';
                    echo $response;
            echo '</td>';
        }
        
        public function response_failed_pre_requirement($response) {
            echo '<td class="pre_requirement">';
                    echo $response;
            echo '</td>';
        }

        public function getstr($length) {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public function getlstr($length) {
            $characters = 'abcdefghijklmnopqrstuvwxyz';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public function fetch_user_by_email($email) {
            global $pdo;
            $query = $pdo->prepare("SELECT * FROM user WHERE user_email = ?");
            $query->bindValue(1, $email);
            $query->execute();
            
            return $query->fetch();
        }

        public function fetch_user_by_id($id) {
            global $pdo;
            $query = $pdo->prepare("SELECT * FROM user WHERE user_ID = ?");
            $query->bindValue(1, $id);
            $query->execute();
            
            return $query->fetch();
        }
    }