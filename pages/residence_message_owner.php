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
}
?>
<div class="container">
  <div class="container chat">
    <h4>Residence message owner: </h4><br>
    <form class="chat_form" action="?pg=chat" method="POST">
      <div class ="text_msg">
      <textarea name="text_message"  class="span--full--width" required style="margin: 0px; width: 413px; height: 100px;"> </textarea>
        </div>
        <button type="submit">Send message</button>
    </form>
  </div>
</div>