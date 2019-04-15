<?php
  //  if (isset($_GET['login']) && $_GET['login'] == 'error') {
    //    echo'  <p class="error__red" >Wrong username or password</p>';
    //}
?>

<section class="login__box">
    <form action="index.php?pg=v_login" method="POST" class="login__form">
        <input class="bg--gray--main span--full--width login--input 
            <?php
                if(isset($_GET['error']) & $_GET['error'] == 'login') {
                    echo 'error--red--border" autofocus="autofocus" onkeyup = "updateError(this)"';
                }
            ?>" type="text" name="email" placeholder="E-mail" id="login_email"> 
        <input class="bg--gray--main span--full--width login--input
            <?php
                if(isset($_GET['error']) & $_GET['error'] =='login') {
                    echo 'error--red--border" onkeyup = "updateError(this)"';
                }
            ?>" type="password" name="pwd" placeholder="Passord" id="login_pwd">
        <button class="login--input" type="submit" name="submit">Login</button>
    </form> 
    <form action="index.php?pg=signup" method="POST" class="signup__form">
        <button type="submit" name="submit" class="login--input">Signup</button>
    </form> 
</section>


<script>
    function updateError(element){
    let obj = element;
	let klasse = 'error--red--border';

	if (obj.value != '') {
		if (obj.classList.contains(klasse)) {
			obj.classList.remove(klasse);
		}
	} else {
		if (!obj.classList.contains(klasse)) {
			obj.classList.add(klasse);
		}
    }
}

</script>
