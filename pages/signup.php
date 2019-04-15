<?php
// Ser etter submit action
if (isset($_POST['submit_signup'])) {
    echo 'test';
    include_once('include/pdo_con_inc.php');
    include_once('include/class_signup.php');
    
    // Oppretter signup objekt, slik at metodene i signup kan brukes
    $signup = NEW Signup();
    
    // Tar dataen fra formen i POST
    // Konverterer navn og mail til lowercase
    $firstname = strtolower($_POST['firstname']);
    $lastname = strtolower($_POST['lastname']);
    $email = strtolower($_POST['email']);
    $pwd = $_POST['pwd'];
    $checked_gdpr = $_POST['gdpr_check'];


    // Rekkefølge: Firstname til GDPR
    if (empty($firstname) || empty($lastname) || empty($email)|| empty($pwd) || empty($checked_gdpr)) {

        if(empty($firstname)) {

            header("Location: ?pg=signup&error=empty_firstname");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($lastname)) {

            header("Location: ?pg=signup&error=empty_lastname");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($email)) {

            header("Location: ?pg=signup&error=empty_email");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($pwd)) {

            header("Location: ?pg=signup&error=empty_pwd");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($checked_gdpr)) {

            header("Location: ?pg=signup&error=empty_checked_gdpr");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }


    } else {

        // Skjekker om navn har gyldig innput
        if (!preg_match("/^[a-zA-Z\040\.\-]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)) {
            header("Location: ?pg=signup&signup=invalid_name");            // Laster inn siden på nytt med feilkode
            exit();                                                         // Stopper resten av koden

        } else {

            // Skjekker om mailen er gyldig
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ?pg=signup&signup=invalid_email");       // Laster inn siden på nytt med feilkode
                exit();                                                     // Stopper resten av koden

            } else {

                // Sjekker om emailen er ledig
                if ($signup->check_available_email($email) == FALSE) {
                    header("Location: ?pg=signup&signup=invalid_email");   // Laster inn siden på nytt med feilkode
                    exit();                                                 // Stopper resten av koden
                } else {

                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);     // Hasher passordet
                    // Setter brukeren inn i databasen
                    $signup->insert_new_user($firstname, $lastname, $email, $hashedPwd);
                    $_SESSION['signup_u_firstname'] = $firstname;
                    $_SESSION['signup_u_lastname'] = $lastname;
                    header("Location: ?pg=main&signup=signup_success");    // Sender brukeren til fremsiden
                    exit();                                                 // Stopper resten av koden
                }
            }
        }
    }

} else {
?>


<h1 class="main__headline">Signup</h1>


<form class="main_input" action="?pg=signup" method="POST" autocomplete="off"> 
    <h6>E-mail *</h6>
    <input class="span--full--width
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_email') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" type="text" name="email" id="email" placeholder="" onfocus="rmv()" onfocusout="emailvalidator()" required>
    <h6 class="span--1to3" id="valid2"></h6>
    
    <h6 class="span--1to2">First name</h6>
    <h6 class="span--2to3">Surname</h6>
    <input class="span--1to2
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_firstname') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" type="text" name="firstname" placeholder="" required>
    <input class="span--2to3
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_lastname') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" type="text" name="lastname" placeholder="" required>
    
    <h6 class="span--1to2">Password</h6>
    <h6 class="span--2to3">Retype password</h6>
    <input class="span--1to2
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_pwd') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" type="password" name="pwd" id="pwd1"  placeholder="" onkeyup="passwordvalidate()" required>
    <input class="span--2to3" type="password" name="pwd_rtype" id="pwd2" onkeyup="passwordvalidate()" placeholder="" required>
    <h6 class="span--1to3" id="valid"></h6>
    <button class="span--full--width" type="submit" name="submit_signup">Sign up</button>
    <h6></h6>
    <section class="span--full--width">
        <label>
            <input class="span--1to2
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_checked_gdpr') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" type="checkbox" id="gdpr_check" name="gdpr_check" required>
            Jeg aksepterer ShareBNBs
        </label>
        <a href="?pg=gdpr" class="span--1to2">brukerbetingelser</a>
    </section>
</form>   
<script src="JS/signup.js"></script>
<section class="main__footer__spacer"></section>

<?php } ?> 