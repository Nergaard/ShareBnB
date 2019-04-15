<?php
if (!isset($_SESSION['u_id'])) {
    header("Location: index.php?pg=error404");
    exit();
} else {
// Ser etter submit action
if (isset($_POST['submit'])) {

    // echo var_dump($_POST);
    
    
    
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
        include_once('include/pdo_con_inc.php');
        include_once('include/class_residence.php');
        
        // Setter leiligheten inn i databasen
        // Oppretter signup objekt, slik at metodene i signup kan brukes
        $res = NEW Residence();

        $residence_ID = $_GET['id'];
        $res->update_residence($residence_ID, $headline, $address, $zipcode, $city, $country, $price, $size, $bedrooms, $main_sleeps, $extra_sleeps, $residence_type, $description, $owner_email, $subleaser_email);
        $headerlocation = "?pg=residence_view&id=".(String)$residence_ID."&?status=upload_success";
        header('Location: '.$headerlocation);
        exit();
    }

} else {
    if (!isset($_GET['id'])) {    
        header("Location: ?pg=404");
        exit();
    } else {
        include_once('include/pdo_con_inc.php');
        include_once('include/class_residence.php');
        $res = NEW Residence();

        $residence = $res->fetch_residence_by_id($_GET['id']);
        $headline = ucfirst($residence['residence_headline']);
        $address = ucfirst($residence['residence_address']);
        $zipcode = $residence['residence_zipcode'];
        $city = ucfirst($residence['residence_city']);
        $country = ucfirst($residence['residence_contry']);
        $price = $residence['residence_price'];
        $size = $residence['residence_size'];
        $bedrooms = $residence['residence_bedrooms'];
        $main_sleeps = $residence['residence_main_sleeps'];
        $extra_sleeps = $residence['residence_extra_sleeps'];
        $type = $residence['residence_type'];
        $description = ucfirst($residence['residence_description']);
        $owner_email = $residence['owner_email']; 
        $subleaser_email = $residence['subleaser_email'];
?>

<h1 class="main__headline">Edit Residence</h1>

<form class="add_residence" action="?pg=residence_edit&id=<?php echo $_GET['id'];?>" method="POST"
    enctype="multipart/form-data" autocomplete="off">

    <h6 class="span--1to4">Address *</h6>
    <h6>Zip code*</h6>
    <input type="text" class="span--1to4" name="address" placeholder="" value="<?php echo $address; ?>" required>
    <input type="number" class="" name="zipcode" placeholder="" value="<?php echo $zipcode; ?>" required>

    <h6 class="span--1to3">City *</h6>
    <h6 class="span--3to5">Contry *</h6>
    <input type="text" class="span--1to3" name="city" placeholder="" value="<?php echo $city; ?>" required>
    <input type="text" class="span--3to5" name="country" placeholder="" value="<?php echo $country; ?>" required>


    <hr class="span--full--width">

    <h6 class="span--1to3">Owners e-mail *</h6>
    <h6 class="span--3to5">Subleasers e-mail</h6>
    <input type="text" class="span--1to3" name="owner_email" placeholder="" value="<?php echo $owner_email; ?>">
    <input type="text" class="span--3to5" name="subleaser_email" placeholder="" value="<?php echo $subleaser_email; ?>">


    <hr class="span--full--width">


    <h6 class="span--1to2">Residence type *</h6>
    <h6 class="span--2to4">Price ( kr/night ) *</h6>
    <h6 class="">Size ( m<sup>2</sup> ) *</h6>
    <select name="residence_type" class="" required>
        <option disabled>-- Residence type --</option>
        <option <?php if ($type == 4) {echo 'selected';} ?> value="room_shared">Shared room</option>
        <option <?php if ($type == 3) {echo 'selected';} ?> value="room_private">Private room</option>
        <option <?php if ($type == 2) {echo 'selected';} ?> value="flat">Flat</option>
        <option <?php if ($type == 1) {echo 'selected';} ?> value="house">House</option>
    </select>
    <input type="number" class="span--2to4" name="price" placeholder="" value="<?php echo $price; ?>" required>
    <input type="number" class="" name="size" placeholder="" value="<?php echo $size; ?>" required>

    <h6 class="span--1to2">Bedrooms *</h6>
    <h6 class="span--2to4">Beds *</h6>
    <h6 class="">Extra sleeps <sup>( ? )</sup></h6>
    <input type="number" class="" name="bedrooms" placeholder="" value="<?php echo $bedrooms; ?>" required>
    <input type="number" class="span--2to4" name="main_sleeps" placeholder="" value="<?php echo $main_sleeps; ?>"
        required>
    <input type="number" class="" name="extra_sleeps" placeholder="" value="<?php echo $extra_sleeps; ?>">


    <hr class="span--full--width">

    <h6>Headline *</h6>
    <input type="text" class="span--full--width " name="headline" placeholder="" value="<?php echo $headline; ?>"
        required>

    <h6>Description: </h6>
    <textarea name="description" class="span--full--width"><?php echo $description; ?></textarea>


    <hr class="span--full--width">


    <!-- 
            <h6>Main image </h6>
            <input type="file" class="span--full--width upload" name="fileToUpload">
-->
    <button type="submit" class="span--full--width" name="submit">Update</button>
</form>
<!--                                T  A   B   L   E                    -->
<?php // include_once('pages/tableToAp.php'); ?>

<!--                                T  A   B   L   E    E N D S                 -->

<?php include_once('modules/main__footer__spacer.php'); ?>

<?php }}} ?>