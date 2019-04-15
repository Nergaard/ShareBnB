<?php
    include_once('include/pdo_con_inc.php');
    include_once('include/class_residence.php');
    if (isset($_GET['where'])) {
        if (empty($_GET['where'])) {
            header("Location: index.php?pg=main&error=name");
            exit();
        }
        if (!empty($_GET['from']) || !empty($_GET['to'])) {
            if (empty($_GET['from']) || empty($_GET['to'])) {
                echo 'feilmeldingen!!';
                header("Location: index.php?pg=main&error=dates");
                exit();
            } 
        }
        $_SESSION['checkin'] = $_GET['from'];
        $_SESSION['checkout'] = $_GET['to'];
    ?>

    <section id="cardcontainer" class="cardcontainer">
        <?php
            // NB!! Denne funksjonen er flyttet til "modules/filter_navbar.php"
                // $res = new Residence;
                // $res->search_by_city_v2($_GET['where']);
        ?>
    </section>
    <!-- <section class="main__footer__spacer spacer_sml"></section> -->
<?php
}