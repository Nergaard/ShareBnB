<?php
    class Message {
        public function insert_new_message($message, $sreciver_id) {
            if (!empty($message) && $message != " ") {
                // include_once('include/class_residence.php');
                // $res = NEW Residence();
                // $user_id = (Int)$res->get_user_id_by_email($_SESSION['u_email']);
                // Man kan bruke de tren linjene ovenfor, men IDen til den innloggede
                // brukeren ligger også i session, så det er enklere å bare hente den ut direkte ;)
                $user_id = (Int)$_SESSION['u_id'];
                global $pdo;
                $query = $pdo->prepare("INSERT INTO chat (chat_from_user_ID, chat_to_user_ID, chat_timestamp, chat_message) 
                                                VALUES (?, ?, ?, ?)");
                $query->bindValue(1, $user_id);
                $query->bindValue(2, (Int)$sreciver_id);
                $query->bindValue(3, time());
                $query->bindValue(4, $message);
                $query->execute();
            }
        }

        public function fetch_chat_between_users($uid1, $uid2) {
            global $pdo;
            $query = $pdo->prepare("SELECT * FROM chat WHERE (chat_from_user_ID = ? AND chat_to_user_ID = ?) OR (chat_from_user_ID = ? AND chat_to_user_ID = ?)");
            $query->bindValue(1, $uid1);
            $query->bindValue(2, $uid2);
            $query->bindValue(3, $uid2);
            $query->bindValue(4, $uid1);
            $query->execute();
            return $query->fetchAll();
        }

        public function print_chat($chat) {
            foreach (array_reverse($chat) as $this_message) {
            // foreach ($chat as $this_message) {
                $this->print_chat_message($this_message, $_SESSION['u_id']);
            }
        }

        public function print_chat_message($message, $u_id){
            $message_color = "blue";
            $fontdirection = "rtl";
            $this_date = time();

            if ($u_id == $message['chat_to_user_ID']) {
                $message_color = "green";
                $fontdirection = "";
            }
            if (date('j M Y', $this_date) == date('j M Y', $message['chat_timestamp'])) {
                $this_date = date('H:i' , $message['chat_timestamp']);
            }   else {
                $this_date = date('j M Y', $message['chat_timestamp']);
            }
            ?>
            
            <div class="message__container">
                <span class="<?php echo $fontdirection ?>"><?php echo $this_date; ?></span>
                <p class="<?php echo $message_color ?>"><?php echo $message['chat_message'] ?></p>
            </div>

            <?php
        }

        public function fetch_correspondents_to_userid($u_id) {
            global $pdo;
            // Henter IDen til alle som har en samtale med bruker
            $query = $pdo->prepare("SELECT DISTINCT chat_from_user_ID fra, chat_to_user_ID til
                                    FROM chat 
                                    WHERE (chat_from_user_ID = ? OR chat_to_user_ID = ?)
                                    ");
            $query->bindValue(1, (Int)$u_id);
            $query->bindValue(2, (Int)$u_id);
            $query->execute();
            $query = $query->fetchAll();
            
            // Legger alle brukerIDene inn i et array og 
            // filtrerer ut duplikater samt brukeren selv
            $ids_to_print = array();
            foreach ($query as $this_id) {
                if ($this_id['til'] == $u_id) {
                    $id_to_print = $this_id['fra'];
                } else {
                    $id_to_print = $this_id['til'];
                }
                if (!in_array($id_to_print, $ids_to_print)) {
                    array_push($ids_to_print, (Int)$id_to_print);
                }
            }
            
            // Printer ut resultatet.
            // Brude muligens flyttes...
            include_once('include/class_user.php');
            $usr = NEW User();
            
            foreach ($ids_to_print as $this_id) {
                $this_user = $usr->fetch_user_by_id($this_id);
                echo '<a href="?pg=chat&chat_id=',$this_id,'"><li>',ucfirst($this_user['user_firstname']),' ',ucfirst($this_user['user_lastname']),'</li></a>';
            }
        }
    }