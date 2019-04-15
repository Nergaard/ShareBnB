<!-- </main> -->
<?php
    // if (isset($_GET['pg']) && $_GET['pg'] == 'search') {
    //     include_once('modules/filter_navbar.php');
    // }
?>
<footer class="main_footer">
    <!-- </main> -->
    <?php
        if (isset($_GET['pg']) && $_GET['pg'] == 'chat') {
            include_once('modules/chat_footer.php');
        } else if (isset($_GET['pg']) && $_GET['pg'] == 'search') {
            include_once('modules/filter_navbar.php');
        }
        
        else {
    ?>
    <section class="footer__section">   
        <p>ShareBNB 2019 © Gruppe 13</p>
    </section>  
        <?php } ?>  
</footer>
<script src="JS/main.js"></script>
</body>
</html>