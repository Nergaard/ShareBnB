<?php include('modules/login_check.php'); ?>
<section class="chat__message__container">
    <form class="chat_form" action="?pg=chat&chat_id=<?php echo $_GET['chat_id'] ?>" method="POST">
        <textarea name="text_message" class="text_message"> </textarea>
        <button type="submit">Send message</button>
    </form>
  </section>