
<section class="login__box logout__box__placement">
    <?php echo '<p class="hello__login"> Hei, <strong>', ucfirst($_SESSION['u_firstname']),'</strong></p>' ?>

    <form class="login__form" action="index.php?pg=logout" method="POST"> 
        <button class="login--input last--column" type="submit" name="submit">Log out</button>
    </form> 
</section>