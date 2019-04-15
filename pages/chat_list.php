<?php
session_start();
if (!isset($_SESSION['u_id'])) {
  header("Location: ?pg=404");    // Laster inn siden på nytt med feilkode
  exit();
} else {
  if (isset($_POST['text_message'])) {
    include_once('include/class_message.php');
    $msg = NEW Message();
    $msg->insert_new_message($_POST['text_message']);
    header("Location: ?pg=chat");
  }
?>


<?php
}