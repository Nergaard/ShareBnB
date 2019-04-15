<?php
    include_once('include/login_check.php');
    include_once('include/pdo_con_inc.php');
    include_once('include/class_residence.php');

    $res = NEW Residence();
    
    $residence = $res->fetch_residence_by_id($_GET['id']);
    $img = $res->get_img_link_from_imgID($residence['residence_main_img_ID']);
    // $rating = $res->get_stars_from_float($residence['residence_rating']);
    $rating = $res->get_residence_rating($_GET['id']);
    $address = $residence['residence_address'];

    // Sjekker om leiligheten har en subleaser. Om han har det setter den "message owner" knappen
    // til å sende melding til subleaser. Om den ikke har en subleaser, sender den melding til eier. 
    $residence_administrator = $residence['residence_subleaser_user_ID'];
    if ($residence_administrator == "0") {
        $residence_administrator = $residence['residence_owner_user_ID'];
    }
    if(isset($_POST["rating"])) {
        $rating = (int)($_POST["rating"]); //Selected Value
        $id = (int)($_GET['id']); //ID of current apartment which is meant to be rated

        $query = $pdo->prepare("UPDATE residence
                SET residence_rating_count = residence_rating_count + 1, residence_rating = residence_rating + $rating
                WHERE residence_ID =$id");
        $query->execute();
        header("Location: index.php?pg=residence_view&id=".$id);
        exit();
    }
?>
<section class="card">
    <article>
    <h1 class="residence_view_headline_sml">
        <?php echo ucfirst($residence['residence_headline']); ?>
    </h1>
        <?php
     $address_words = str_replace(" ", "+", $address);
     ?>
        <p>
            <?php echo ucfirst($residence['residence_description'])?>
        </p>
    </article>
    <aside class="residence_view__right">
        <img src="img/uploads/<?php echo $img[0] ?>" alt="" class="span--full--width">
        <aside class="residence_view__right__left">
            <h4 class="rating__stars span--full--width">
                <?php 
                if ($res->get_residence_rating_count((int)($_GET['id']))==0) {
                    echo ($res->get_stars_from_float(3));
                }
                echo ($res->get_stars_from_float(ceil((float)$rating))); ?>
                <small>(<?php echo $res->get_residence_rating_count((int)($_GET['id'])); ?>)</small>
            </h4>
            <p>Beds: <b>
                    <?php echo $residence['residence_main_sleeps']; 
                            if ($residence['residence_extra_sleeps'] != '0') {
                                echo '+',$residence['residence_extra_sleeps'];
                            }
                            ?>
                </b>
            </p>
            <p>Size: <b><?php echo $residence['residence_size']?> m&#178 </b></p>
            <p>Type: <b><?php
            $resType = ucfirst($res->get_residence_type_from_int((int)$residence['residence_type']));
            $print = str_replace("_"," ", $resType);
            echo $print;
            ?> </b></p>
            <p>Price:
                <b>Kr
                    <?php echo $residence['residence_price']?>,- /night
                </b>
            </p>
        </aside>
        <?php if (isset($_SESSION['u_id'])) { ?>
        <aside class="residence_view__right__right">
            <form action="?pg=residence_rent" method="GET">
                <input class="display--none" type="text" name="pg" value="residence_rent">
                <input class="display--none" type="text" name="ad" value="<?php echo $residence_administrator; ?>">
                <input class="display--none" type="text" name="checkin" value="<?php echo $_SESSION['checkin']; ?>">
                <input class="display--none" type="text" name="checkout" value="<?php echo $_SESSION['checkout']; ?>">
                <button type="submit" name="residence_id" value="<?php echo $_GET['id'] ?>">Rent</button>
            </form>
            <form action="?pg=chat&chat_id=<?php echo $residence_administrator; ?>" method="post">
                <button type="submit" name="residence_id" value="<?php echo $_GET['id'] ?>">Message owner</button>
            </form>
            <button type="rate" onclick="show_hide_rate_residence(this)">Rate residence</button>
        </aside>
        <form action="index.php?pg=residence_view&id=<?php echo $_GET['id']; ?>" id="rating__form" class="rating__form display--none" name="rating form" method="post">
            <table class="rating__table">
                <tr class="rating__label">
                    <td><label for="r1">1</label></td>
                    <td><label for="r2">2</label></td>
                    <td><label for="r3">3</label></td>
                    <td><label for="r4">4</label></td>
                    <td><label for="r5">5</label></td>
                </tr>
                <tr class="rating__radio">
                    <td><input type="radio" id="r1" name="rating" value="1" required></td>
                    <td><input type="radio" id="r2" name="rating" value="2"></td>
                    <td><input type="radio" id="r3" name="rating" value="3"></td>
                    <td><input type="radio" id="r4" name="rating" value="4"></td>
                    <td><input type="radio" id="r5" name="rating" value="5"></td>
                </tr>
            </table>
            <button type="submit" name="submit">Rate</button>
        </form>
        <?php } ?>
        <iframe class="map span--full--width" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAXOgrpOHxr06zfgFVnMs16Htlk1SewzF8&q=<?php echo $address_words ?>" allowfullscreen>
        </iframe>
</aside>
</section>