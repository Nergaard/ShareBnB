<?php
if (!isset($_SESSION['u_id'])) {
    header("Location: index.php?pg=error404");
    exit();
} else {
// Ser etter submit action
if (isset($_POST['submit'])) {
    // Tar dataen fra formen i POST
    // Konverterer navn og mail til lowercase
    $headline = strtolower($_POST['headline']);
    $address = strtolower($_POST['address']);
    $zipcode = $_POST['zipcode'];
    $city = strtolower($_POST['city']);
    $country = strtolower($_POST['country']);
    $price = $_POST['price'];
    $size = $_POST['size'];
    $bedrooms = $_POST['bedrooms'];
    $main_sleeps = $_POST['main_sleeps'];
    $extra_sleeps = $_POST['extra_sleeps'];
    $residence_type = strtolower($_POST['residence_type']);
    $description = strtolower($_POST['description']);
    $owner_email = $_POST['owner_email']; 
    $subleaser_email = $_POST['subleaser_email'];

    $_SESSION['POST'] = $_POST;
    // Ser etter tomme felt

    // Rekkefølge: Address til Headline
    if (empty($address) || empty($headline) || empty($zipcode) || empty($city) || empty($owner_email) || empty($country) || empty($price) || empty($size) || empty($bedrooms) || empty($main_sleeps)) {

        if(empty($address)) {

            header("Location: ?pg=residence_new&error=empty_address");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($zipcode)) {

            header("Location: ?pg=residence_new&error=empty_zipcode");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($city)) {

            header("Location: ?pg=residence_new&error=empty_city");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($country)) {

            header("Location: ?pg=residence_new&error=empty_country");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($owner_email)) {

            header("Location: ?pg=residence_new&error=empty_owner_email");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($price)) {

            header("Location: ?pg=residence_new&error=empty_price");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($size)) {

            header("Location: ?pg=residence_new&error=empty_size");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($bedrooms)) {

            header("Location: ?pg=residence_new&error=empty_bedrooms");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($main_sleeps)) {

            header("Location: ?pg=residence_new&error=empty_main_sleeps");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

        if(empty($headline)) {

            header("Location: ?pg=residence_new&error=empty_headline");
            exit(); //Stopper resten av koden om noen av feltene er tomme. 
        }

    } else {
        // Ser om det er lastet opp et bilde
        if (!empty($_FILES['fileToUpload']['name'])) {
            // Inkluderer det som trengs for å laste opp bilde            
            include_once('include/class_img.php');
            $imgage = NEW Img();

            // Kjører metode for å skjekke og laste opp bilde
            $img_upload = $imgage->upload_img($_FILES["fileToUpload"]);
            
            // Leser responsen fra opplastingen av bilde og setter $img variabelen for å lagre bildenavnet i databasen. 
            if ($img_upload[0] === TRUE) {
                $img = $img_upload[1];
            } else {
                $_POST['img_error'] = $img_upload[1];
                header("Location: ?pg=residence_new&error=img_upload_failed");
                exit(); 
            }
        // Om det ikke er lastet opp noe bilde lagres "NULL" som bildenavn i databasen
        } else {
            $img = NULL;
        }
        

        include_once('include/pdo_con_inc.php');
        include_once('include/class_residence.php');

        // Setter leiligheten inn i databasen
        // Oppretter signup objekt, slik at metodene i signup kan brukes
        $res = NEW Residence();
        $res->insert_new_residence($headline, $address, $zipcode, $city, $country, $price, $size, $bedrooms, $main_sleeps, $extra_sleeps, $residence_type, $description, $img, $owner_email, $subleaser_email);
        $_SESSION['POST'] = "";
        header("Location: ?pg=residence_overview&status=upload_success");
        exit();
    }

} else {
?>

<h1 class="main__headline spacer_sml">Add Residence</h1>

<form class="add_residence" action="?pg=residence_new" method="POST" enctype="multipart/form-data" autocomplete="off"> 
    <h6 class="span--1to4">Address *</h6>
    <h6>Zip code*</h6>
    <input type="text" class="span--1to4
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_address') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" name="address" placeholder=""  value="<?php if(isset($_SESSION['POST']['address'])){ echo $_SESSION['POST']['address'];}?>">
    <input type="number" class="
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_zipcode') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" name="zipcode" placeholder="" value="<?php if(isset($_SESSION['POST']['zipcode'])){ echo $_SESSION['POST']['zipcode'];}?>">
    
    <h6 class="span--1to3">City *</h6>
    <h6 class="span--3to5">Contry *</h6>
    <input type="text" class="span--1to3
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_city') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" name="city" placeholder="" value="<?php if(isset($_SESSION['POST']['city'])){ echo $_SESSION['POST']['city'];}?>">
    <input type="text" class="span--3to5
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_country') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" name="country" placeholder="" value="<?php if(isset($_SESSION['POST']['country'])){ echo $_SESSION['POST']['country'];}?>">



    <hr class="span--full--width">


    <h6 class="span--1to3">Owners e-mail *</h6>
    <h6 class="span--3to5">Subleasers e-mail</h6>
    <input type="text" class="span--1to3
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_owner_email') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" onchange="verify_user_id_by_email_with_printout(this)" name="owner_email" placeholder="" value="<?php if(isset($_SESSION['POST']['owner_email'])){ echo $_SESSION['POST']['owner_email'];}?>">
    <input type="text" class="span--3to5" onchange="verify_user_id_by_email_with_printout(this)" name="subleaser_email" placeholder="" value="<?php if(isset($_SESSION['POST']['subleaser_email'])){ echo $_SESSION['POST']['subleaser_email'];}?>">
    <section class="span--1to3" id="owner_email"></section>
    <section class="span--3to5" id="subleaser_email"></section>
    
    
    
    <hr class="span--full--width">
    
    
    
    <h6 class="span--1to2">Residence type *</h6>
    <h6 class="span--2to4">Price ( kr/night ) *</h6>
    <h6 class="">Size ( m<sup>2</sup> ) *</h6>
    <select name="residence_type" class="" required> <!-- Her klarer jeg ikke helt å få til persistence -->
        <option selected disabled>--</option>
        <option value="room_shared">Shared room</option>
        <option value="room_private">Private room</option>
        <option value="flat">Flat</option>
        <option value="house">House</option> 
    </select>
    <input type="number" class="span--2to4
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_price') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" name="price" min="0" placeholder="" value="<?php if(isset($_SESSION['POST']['price'])){ echo $_SESSION['POST']['price'];}?>">
    <input type="number" class="
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_size') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" name="size" min="0" placeholder="" value="<?php if(isset($_SESSION['POST']['size'])){ echo $_SESSION['POST']['size'];}?>">

    <h6 class="span--1to2">Bedrooms *</h6>
    <h6 class="span--2to4">Beds *</h6>
    <h6 class="">Extra sleeps <sup>( ? )</sup></h6>
    <input type="number" class="
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_bedrooms') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" name="bedrooms" min="0" placeholder="" value="<?php if(isset($_SESSION['POST']['bedrooms'])){ echo $_SESSION['POST']['bedrooms'];}?>">
    <input type="number" min="0" class="span--2to4
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_main_sleeps') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" name="main_sleeps" placeholder="" value="<?php if(isset($_SESSION['POST']['main_sleeps'])){ echo $_SESSION['POST']['main_sleeps'];}?>">
    <input type="number" class="" name="extra_sleeps" min="0" placeholder="" value="<?php if(isset($_SESSION['POST']['extra_sleeps'])){ echo $_SESSION['POST']['extra_sleeps'];}?>">
    


    <hr class="span--full--width">


    <h6>Headline *</h6>
    <input type="text" class="span--full--width 
            <?php
                if(isset($_GET['error']) && $_GET['error'] == 'empty_headline') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" name="headline" placeholder=""  value="<?php if(isset($_SESSION['POST']['headline'])){ echo $_SESSION['POST']['headline'];}?>">

    <h6>Description</h6>
    <textarea name="description"  class="span--full--width"><?php if(isset($_SESSION['POST']['description'])){ echo $_SESSION['POST']['description'];}?></textarea>
    



    <hr class="span--full--width">
    
    
    
    <h6>Main image </h6>
    <input type="file" class="span--full--width upload <?php
                if(isset($_GET['error']) & $_GET['error'] == 'img_upload_failed') {
                    echo 'error--red--border" onkeyup = "updateError(this)"';
                }
            ?>" name="fileToUpload" required>
    <!-- <hr class="span--full--width"> -->
    <button type="submit" class="span--last" name="submit">Submit</button>

</form>      
<?php include_once('modules/main__footer__spacer.php'); ?>
<?php }} ?>
