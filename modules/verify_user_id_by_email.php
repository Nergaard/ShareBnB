<?php 
	include_once('../include/pdo_con_inc.php');
    include_once('../include/class_user.php');
    $usr = NEW User();

	$where = $_GET['q'];
    // echo 'verification in progress';
    // echo var_dump($where);
    // echo '<br>';
    // echo var_dump($usr->verify_email_exist($where));
    $email_exists = $usr->verify_email_exist($where);

    if ($email_exists) {
        echo '<h6 class="error--green--text">E-mail verified</h6>';
    } else {
        echo '<h6 class="error--red--text">E-mail not valid</h6>';
    }
?>
