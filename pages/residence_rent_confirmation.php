<?php
	include_once('include/login_check.php');
	include_once('include/pdo_con_inc.php');
	include_once('include/class_residence.php');
	$res = NEW Residence();

	$residence = $res->fetch_residence_by_id($_GET['residence_id']);
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

	$_SESSION['checkin'] = "";
	$_SESSION['checkout'] = "";
?>


<h1 class="main__headline">Rental confirmation</h1>

<form  action="?pg=chat&chat_id=<?php echo $_GET['ad'] ?>" method="POST" class="add_residence" autocomplete="off">
	<h6 class="span--1to4">Address *</h6>
    <h6>Zip code*</h6>
    <input type="text" class="span--1to4" name="address" placeholder="" value="<?php echo $address; ?>" disabled>
    <input type="number" class="" name="zipcode" placeholder="" value="<?php echo $zipcode; ?>" disabled>

    <h6 class="span--1to3">City *</h6>
    <h6 class="span--3to5">Contry *</h6>
    <input type="text" class="span--1to3" name="city" placeholder="" value="<?php echo $city; ?>" disabled>
	<input type="text" class="span--3to5" name="country" placeholder="" value="<?php echo $country; ?>" disabled>
	
	<hr class="span--full--width">

	<h6 class="span--1to3">Checkin</h6>
	<h6 class="span--3to5">Checkout</h6>
	<input type="date" class="span--1to3" value="<?php echo $_GET['checkin']; ?>" disabled>
	<input type="date" class="span--3to5" value="<?php echo $_GET['checkout']; ?>" disabled>

	<hr class="span--full--width">

    <h6 class="span--1to2">Residence type *</h6>
    <h6 class="span--2to4">Price ( kr/night ) *</h6>
    <h6 class="">Size ( m<sup>2</sup> ) *</h6>
    <select name="residence_type" class="" disabled>
        <option disabled>-- Residence type --</option>
        <option <?php if ($type == 4) {echo 'selected';} ?> value="room_shared">Shared room</option>
        <option <?php if ($type == 3) {echo 'selected';} ?> value="room_private">Private room</option>
        <option <?php if ($type == 2) {echo 'selected';} ?> value="flat">Flat</option>
        <option <?php if ($type == 1) {echo 'selected';} ?> value="house">House</option>
    </select>
    <input type="number" class="span--2to4" name="price" placeholder="" value="<?php echo $price; ?>" disabled>
    <input type="number" class="" name="size" placeholder="" value="<?php echo $size; ?>" disabled>

    <h6 class="span--1to2">Bedrooms *</h6>
    <h6 class="span--2to4">Beds *</h6>
    <h6 class="">Extra sleeps <sup>( ? )</sup></h6>
    <input type="number" class="" name="bedrooms" placeholder="" value="<?php echo $bedrooms; ?>" disabled>
    <input type="number" class="span--2to4" name="main_sleeps" placeholder="" value="<?php echo $main_sleeps; ?>"
        disabled>
    <input type="number" class="" name="extra_sleeps" placeholder="" value="<?php echo $extra_sleeps; ?>" disabled>
	
    <hr class="span--full--width">
	<button type="submit" class="span--full--width">Contact Owner</button>

    <hr class="span--full--width">

	<p class="span--full--width">
	This is a confirmation stating that the residence has now been reserved to you. You´ll now have to wait for approval from the residence administrator before you can finalise the rental contract. For any further questions regarding the apartment, please feal free to contact the owner. 
	</p>
	
</form>

<?php include_once('modules/main__footer__spacer.php'); 