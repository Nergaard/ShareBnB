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

    // Ser etter tomme felt
    // if (empty($headline) || empty($address) || empty($zipcode) || empty($city) || empty($city) || empty($country) || empty($price) || empty($size) || empty($bedrooms)) {
    if (1 != 1) {
        header("Location: ?pg=residence_new&?error=empty_fields");    // Laster inn siden på nytt med feilkode
        exit(); //Stopper resten av koden om noen av feltene er tomme. 

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
                header("Location: ?pg=residence_new&?error=img_upload_failed");
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
        header("Location: ?pg=residence_overview&?status=upload_success");
    }

} else {
?>

<h1 class="main__headline spacer_sml">Add Residence</h1>

<form class="add_residence" action="?pg=residence_new" method="POST" enctype="multipart/form-data" autocomplete="off"> 
    <h6 class="span--1to4">Address *</h6>
    <h6>Zip code*</h6>
    <input type="text" class="span--1to4" name="address" placeholder="" required>
    <input type="number" class="" name="zipcode" placeholder="" required>
    
    <h6 class="span--1to3">City *</h6>
    <h6 class="span--3to5">Contry *</h6>
    <input type="text" class="span--1to3" name="city" placeholder="" required>
    <input type="text" class="span--3to5" name="country" placeholder="" required>



    <hr class="span--full--width">


    <h6 class="span--1to3">Owners e-mail *</h6>
    <h6 class="span--3to5">Subleasers e-mail</h6>
    <input type="text" class="span--1to3" name="owner_email" placeholder="" >
    <input type="text" class="span--3to5" name="subleaser_email" placeholder="">
    
    
    
    <hr class="span--full--width">
    
    
    
    <h6 class="span--1to2">Residence type *</h6>
    <h6 class="span--2to4">Price *</h6>
    <h6 class="">Size *</h6>
    <select name="residence_type" class="" required>
        <option selected disabled>--</option>
        <option value="room_shared">Shared room</option>
        <option value="room_private">Private room</option>
        <option value="flat">Flat</option>
        <option value="house">House</option> 
    </select>
    <input type="number" class="span--2to4" name="price" placeholder="" required>
    <input type="number" class="" name="size" placeholder="" required>

    <h6 class="span--1to2">Bedrooms *</h6>
    <h6 class="span--2to4">Beds *</h6>
    <h6 class="">Extra sleeps</h6>
    <input type="number" class="" name="bedrooms" placeholder="" required>
    <input type="number" class="span--2to4" name="main_sleeps" placeholder="" required>
    <input type="number" class="" name="extra_sleeps" placeholder="">
    


    <hr class="span--full--width">


    <h6>Headline *</h6>
    <input type="text" class="span--full--width " name="headline" placeholder="Headline" required>

    <h6>Description</h6>
    <textarea name="description"  class="span--full--width"> </textarea>
    



    <hr class="span--full--width">
    
    
    
    <h6>Main image </h6>
    <input type="file" class="span--full--width upload" name="fileToUpload">
    <!-- <hr class="span--full--width"> -->
    <button type="submit" class="span--last" name="submit">Submit</button>

</form>      
<?php include_once('modules/main__footer__spacer.php'); ?>
<?php }} ?>
