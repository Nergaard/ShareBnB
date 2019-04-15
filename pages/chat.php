<?php
session_start();
if (!isset($_SESSION['u_id']) || !isset($_GET['chat_id'])) {
  header("Location: ?pg=404");    // Laster inn siden på nytt med feilkode
  exit();
} else {
  include_once('include/class_residence.php');
  include_once('include/class_message.php');
  $res = NEW Residence();
  $msg = NEW Message();

  if (isset($_POST['text_message'])) {
    $msg->insert_new_message(nl2br($_POST['text_message']), $_GET['chat_id']);
    header("Location: ?pg=chat&chat_id=".$_GET['chat_id']);
    exit();
  }
  $chat = $msg->fetch_chat_between_users($_SESSION['u_id'], $_GET['chat_id']);
}
?>
<section class="container">
  <section class="chat__container span--full--width">
    <?php 
      $msg->print_chat($chat);
    ?>
  </section>
</section>