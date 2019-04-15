<?php
    // Ser etter submit action
    session_start();
    // echo 'POST:',var_dump($_POST);
    if (isset($_POST['submit'])) {
        // echo var_dump($_POST);

        // Inkluderer nødvendigheter
        include_once('include/pdo_con_inc.php');
        include_once('include/class_login.php');
        
        // Oppretter et Login-objekt, for å få tilgang til metodene til Login
        $login = NEW Login();
        
        // Lagrer innput og konverterer email til lowercase
        $email = strtolower($_POST['email']);
        $pwd = $_POST['pwd'];
        
        // Sjekk for tomme felt
        if (empty($email) || empty($pwd)) {
            
            header("Location: index.php?error=login");                      // Redirigerer til frensiden med feilkode
            exit();                                                         // Stopper resten av koden fra å kunne kjøre

        } else {

            if ($login->verify_existing_email($email) == FALSE) {
                
                header("Location: index.php?error=login"); // Redirigerer til frensiden med feilkode
                echo "Invalid Username and Password";
                exit();                                                     // Stopper resten av koden fra å kunne kjøre

            } else {
                
                $usr = $login->fetch_user_by_email($email);

                //Sjekk om passordene samsvarer
                $hashedPdwCheck = password_verify($pwd, $usr['user_pwd']);

                if ($hashedPdwCheck == false) {

                    header("Location: index.php?error=login");              // Redirigerer til frensiden med feilkode
                    exit();                                                 // Stopper resten av koden fra å kunne kjøre

                } elseif($hashedPdwCheck == true) {

                    //Logger inn bruker
                    $_SESSION['u_id'] = $usr['user_ID'];
                    $_SESSION['u_firstname'] = $usr['user_firstname'];
                    $_SESSION['u_lastname'] = $usr['user_lastname'];
                    $_SESSION['u_email'] = $usr['user_email'];
                    // echo var_dump($_SESSION);
                    header("Location: index.php?pg=user_overview");   // Redirigerer til frensiden med feilkode
                    exit();                                                 // Stopper resten av koden fra å kunne kjøre

                } else {

                    header("Location: index.php?error=login");              // Redirigerer til frensiden med feilkode
                    exit();                                                 // Stopper resten av koden fra å kunne kjøre

                }
            }
        }
    }  