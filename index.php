<?php
	include_once('include/pdo_con_inc.php');
	include_once('pages/head.php');
	include_once('modules/header.php');
?>

<main class="main_wrapper">
		<?php 
			if (isset($_SESSION['u_id'])) {
				include('modules/main_menu.php'); 
			}
		?>
		<?php include('include/include.php'); ?>
</main>

<?php include_once('pages/footer.php'); ?>
