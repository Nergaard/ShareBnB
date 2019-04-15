
    <?php 
        if (isset($_GET['signup']) && $_GET['signup'] == 'signup_success') {
            echo '<h1 class="main__headline">';
            echo '<p>',ucwords($_SESSION['signup_u_firstname']),' ',ucfirst($_SESSION['signup_u_lastname']),', velkommen til ShareBNB</p>';
        } else {
            echo '<h1 class="main__headline"></h1>';
            // echo '<h1 class="main__headline">Search</h1>';
            // echo '<h1 class="main__headline"></h1>';
        }

    ?>
<form  action="?pg=search" method="GET" class="main_input" autocomplete="off">
    <input class="display--none" type="text" name="pg" value="search">
    <!-- <h6 class="span--full--width">Where</h6> -->
    <section id="search__where" class="span--full--width">
        <input type="text" name="where" placeholder="Hvor" id="input__search__where" onkeyup="fetch_search_alternatives(this)" class="span--full--width <?php
                if(isset($_GET['error']) & $_GET['error'] == 'name') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
                ?>" required>
        <section id="search__results">
        </section>
    </section>
    <h6 class="span--2to3"></h6>
    <h6 class="span--2to3"></h6>
    <input type="date" name="from" placeholder="dd/mm/yyyy" <?php
                if(isset($_GET['error']) & $_GET['error'] == 'dates') {
                    echo 'class="error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?> 
    required>
    <input type="date" name="to" placeholder="dd/mm/yyyy" <?php
                if(isset($_GET['error']) & $_GET['error'] == 'dates') {
                    echo 'class="error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?> 
    
    required>
    <button type="submit" class="span--full--width">Submit</button>
</form>
<?php include_once('modules/main__footer__spacer.php'); ?>