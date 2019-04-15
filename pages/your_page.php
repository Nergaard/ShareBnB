<!-- <section class="cardcontainer"> -->
<?php
if (!isset($_SESSION['u_id'])) {
    header("Location: index.php?pg=error404");
    exit();
} else {
	include_once("include/class_signup.php");
	session_start();
	if (isset($_POST['submit'])){
        
        $signp = NEW Signup();
        
        $firstname = strtolower($_POST['firstname']);
        $lastname = strtolower($_POST['lastname']);
        $email = strtolower($_POST['email']);
        $pwd = $_POST['pwd'];
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);     // Hasher passordet
        $userID = $_SESSION['u_id'];
        $signp->update_user($firstname, $lastname, $email, $hashedPwd, $userID);
        
        //Oppdaterer innloggede variabler
        $_SESSION['u_firstname'] = $firstname;
        $_SESSION['u_lastname'] = $lastname;
        $_SESSION['u_email'] = $email;    
	}
    
	$sign = NEW Signup();
	$email = $_SESSION['u_email'];
	$user = $sign->fetch_user_by_email($email);
	
    ?>
<h1 class="main__headline">Din Side</h1>

<h1>Dette er dine personlige opplysninger. Du kan oppdatere de om du ønsker.<br><br></h1>
<form class="main_input" action="?pg=user_page" method="POST" autocomplete="off"> 
    
    <!-- <h6 class="span--full--width">E-mail *</h6> -->
    <input class="span--full--width" type="text" name="email" value="<?php echo $user['user_email']; ?>" required>
    
    <h6 class="span--1to2">First name *</h6>
    <h6 class="span--2to3">Surname *</h6>
    <input class="span--1to2 capital" type="text" name="firstname" value="<?php echo $user['user_firstname']; ?>" required>
    <input class="span--2to3 capital" type="text" name="lastname" value="<?php echo $user['user_lastname']; ?>"  required>
    
    <h6 class="span--1to2">New password</h6>
    <h6 class="span--2to3">Retype password</h6>
    <input class="span--1to2" type="password" name="pwd" placeholder="Password" required>
    <input class="span--2to3" type="password" name="pwd_rtype" placeholder="Retype password" required>
    <!-- <h6></h6> -->
    <button class="span--full--width" type="submit" name="submit">Oppdater</button>
</form>

<hr class="span--full--width">
<!-- </section> -->
<form class="span--full--width" action="?pg=delete_page" method="POST">
	<button>Slett min bruker</button>
</form>
<?php 
    include_once('modules/main__footer__spacer.php');
}