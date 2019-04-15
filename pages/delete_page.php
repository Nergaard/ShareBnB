
<?php 
if (!isset($_SESSION['u_id'])) {
    header("Location: index.php?pg=error404");
    exit();
}
session_start();
include_once("include/class_signup.php");
if (isset($_POST['submit'])){
    $signp = NEW Signup();
    $userID = $_SESSION['u_id'];
    $signp->delete_user($userID);
    session_start();
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
    $userName = $_SESSION['u_firstname'];
 ?>

<h1 class="main__headline">Velkommen tilbake en annen gang, <?php echo $userName?></h1>
<section class="main_input">
<p class="span--full--width">Du har alltid rett til å slette din ShareBNB-bruker.
Vær klar over at denne handlingen er permanent. Du kan ikke få tilbake data du har slettet. <br></br>
Du er alltid velkommen til å opprette en ny bruker hos oss ved en senere anledning.</p> <br>

<form class="span--full--width" action="" method="POST">
	<input class="red" type="submit" name="submit" value="Slett min bruker" />
</form>
</section>
<section class="main__footer__spacer"></section>