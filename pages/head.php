<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>ShareBNB</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleMedia.css">
		<link rel="stylesheet" href="css/chatStyle.css">
		<?php 
			if (isset($_SESSION['u_id'])) { ?> 
				<link rel="stylesheet" type="text/css" href="css/styleMediaLoggedInn.css"> 
			<?php }
		?>
    <link href="https://fonts.googleapis.com/css?family=Oswald:500|Roboto:300,300i,400|Josefin+Sans:100,300|Raleway:300,400,700" rel="stylesheet">
	</head>

	<body>
	<script src="JS/preload.js"></script>
