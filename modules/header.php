<header class="main_header">
    <nav class="logo">
        <h1><a href="index.php?pg=main">ShareBNB</a></h1>
	</nav>
	
    <nav class="login">
		<?php 
			if (isset($_SESSION['u_id'])) {
				// echo '<nav class="menu__button"></nav>';
				// include_once('modules/logout.php'); 
				?>
				<nav class="menu_button__container">	
					<div class="menu_button" onclick="menuActive(this)">
							<div class="bar1"></div>
							<div class="bar2"></div>
							<div class="bar3"></div>
						</div>
				</nav>
				<?php
			} else {
				include('modules/login.php');
			}
			?>
    </nav>
		<?php 
			if (!isset($_SESSION['u_id'])) {
				include_once('modules/media_menu.php'); 
			}
		?>
</form>
</header>