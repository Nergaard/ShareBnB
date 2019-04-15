<?php
 if(!isset($_GET['pg'])) {  // sjekker om $_GET['pg'] ikke inneholder en verdi
    $pg = 'main';           // Hvis ikke $_GET['pg'] inneholder en verdi --> Gi variabelen $pg verdien 'main'
 } else {
    $pg = $_GET['pg'];      // Hvis $_GET['pg'] inneholder en verdi --> Gi variabelen $get innholdet i $_GET['pg']
 }
    
   // Hvis $pg er lik 'filnavn' --> Inkluderer filen 'filnavn.php'

   // Alle elementer legges inne i denne if setningen.
   // Elementer som ikke skal fungere når man er logget inn, må legges inn begge plasser. 
   if (isset($_SESSION['u_id'])) {
      // Åpne elementer
      if($pg == 'main') include('pages/main.php');
      else if($pg == 'signup') include('pages/signup.php');
      else if($pg == 'search') include('pages/search.php');
      else if($pg == 'apartments') include('pages/apartments.php');
      else if($pg == 'gdpr') include('pages/gdpr.php');
      else if($pg == 'tableToAp') include('pages/tableToAp.php');
      
      else if($pg == 'v_login') include('include/login_inc.php');
      else if($pg == 'logout') include('include/logout_inc.php');
      else if($pg == '404') include('pages/404.php');
      
      
      // Elementer kunn for innlogging
      else if($pg == 'table') include('pages/table.php');
      else if($pg == 'rental_overview') include('pages/rental_overview.php');
      else if($pg == 'residence_view') include('pages/residence_view.php');
      else if($pg == 'residence_edit') include('pages/residence_edit.php');
      else if($pg == 'residence_new') include('pages/residence_new.php');
      else if($pg == 'residence_rent') include('pages/residence_rent.php');
      else if($pg == 'residence_rent_confirmation') include('pages/residence_rent_confirmation.php');
      else if($pg == 'residence_overview') include('pages/residence_overview.php');
      else if($pg == 'user_overview') include('pages/user_overview.php');
      else if($pg == 'residence_message_owner') include('pages/residence_message_owner.php');
      else if($pg == 'chat') include('pages/chat.php');
      else if($pg == 'user_page') include('pages/your_page.php');
      else if($pg == 'delete_page') include('pages/delete_page.php');
      else if($pg == 'message_center') include('pages/message_center.php');
      else {include('pages/404.php');}
   } else {  
      // Åpne elementer
      if($pg == 'main') include('pages/main.php');
      else if($pg == 'residence_view') include('pages/residence_view.php');
      else if($pg == 'signup') include('pages/signup.php');
      else if($pg == 'search') include('pages/search.php');
      else if($pg == 'apartments') include('pages/apartments.php');
      else if($pg == 'gdpr') include('pages/gdpr.php');
      else if($pg == 'tableToAp') include('pages/tableToAp.php');
      
      
      else if($pg == 'v_login') include('include/login_inc.php');
      else if($pg == 'logout') include('include/logout_inc.php');
      else if($pg == '404') include('pages/404.php');
      else {include('pages/404.php');}
   }
?>

