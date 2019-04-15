<?php include('modules/login_check.php'); 
// include_once('include/class_residence.php');
include_once('include/class_message.php');
// $res = NEW Residence();
$msg = NEW Message();

// echo var_dump($_SESSION['u_id']);
?>


<section class="chat__list span--full--width">
    <ul class="">
        <?php $msg->fetch_correspondents_to_userid($_SESSION['u_id']); ?>
    </ul> 
</section>