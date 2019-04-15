<?php include('modules/login_check.php'); ?>
    <section class="main_menu" id="main_menu">
        <!-- <h1>Menu</h1> -->
        <nav id="main_menu_content" class="main_menu_content">
        <?php include_once('modules/logout.php'); ?>
            <ul class="main_menu__items">
                <li><a href="?pg=residence_new">Add a residence</a></li>
                <li><a href="?pg=user_overview">Your apartments</a></li>
                <li><a href="?pg=message_center">Message center</a></li>
                <li><a href="?pg=user_page">Preferences</a></li>
                <li><a href="?pg=table">Renting out</a></li>
                <li><a href="?pg=rental_overview">Renting</a></li>
            </ul> 
        </nav>
    </section>
