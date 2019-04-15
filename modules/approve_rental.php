<?php 
	include_once('../include/pdo_con_inc.php');
    include_once('../include/class_residence.php');
    $res = NEW Residence();

	// $owner_id = $_GET['owner_id'];
    $rental_id = (Int)$_GET['rental_id'];
    $owner_id = (Int)$_GET['owner_id'];

    $res->rental_aprove_by_owner($owner_id, $rental_id);
?>
<td><input type="checkbox" value="" id="" name=""checked disabled></td>