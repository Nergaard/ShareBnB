<?php
if (!isset($_SESSION['u_id'])) {
  header("Location: index.php?pg=error404");
  exit();
} else {
    include_once('include/pdo_con_inc.php');
    include_once('include/class_residence.php');
    session_start();
    $user_id = $_SESSION['u_id'];
    //Hvis brukeren har oppdatert om det er ønskelig med fremleie eller ikke oppdateres database ved hjelp av allow_sublet.
    if (isset($_POST['submit'])){

      $sublet = New Residence();

      $residence_id = (int)($_POST['residence_ID']);
      $checked = strtolower($_POST['sub']);
      if($checked == "on"){
        $checked = 1;
      }else{
        $checked = 0;
      }

      $sublet->allow_sublet($residence_id, $checked);
    }
?>

<h1 class="main__headline">Dine leiligheter</h1>
<section class="cardcontainer">
<?php

    $res = new Residence;
    $res->search_by_id($user_id);
?>
<script src="JS/subletting.js"></script>
</section>
<?php 
  include_once('modules/main__footer__spacer.php'); 
} 