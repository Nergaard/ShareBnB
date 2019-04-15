<?php
	// DB connection variables
	$servername = "";
	$db_name = "";
	$db_username = "";
	$db_password = "";

	// Include class for testing purposes
	include_once('include/class_test.php');

	// Include classes to test
	include_once('include/class_img.php');
	include_once('include/class_login.php');
	include_once('include/class_message.php');
	include_once('include/class_residence.php');
	include_once('include/class_signup.php');
	include_once('include/class_user.php');

	$test = NEW Test();

	// Initiate classes to test
	$signup = NEW Signup();
	$login = NEW Login();
	$usr = NEW User();
	$res = NEW Residence();
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ShareBNB - functionTesting</title>

	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
			max-width: 600px;
			margin: 15px;
		}

		td,
		th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #dddddd;
		}
		.error {
			background-color: red;
			color: white;
		}
		
		.ok {
			background-color: green;
			color: white;
		}

		.pre_requirement {
			background-color: blue;
			color: white;
		}
	</style>
</head>
<body>
	
	<h1>
		Testpage
	</h1>

<form action="testing.php" method="post">
		<button type="submit" name="run_tests">Run tests <?php if (isset($_POST['run_tests'])){echo ' again';}?></button>
</form>

<?php 
if (isset($_POST['run_tests'])){ ?>
	<table>
		<tr>
			<th>Test</th>
			<th>Status</th>
		</tr>
<?php


// Henter de aktive variablene for å kontakte databasen fra 'include/pdo_con_inc.php'.
try {
	$filen = file('include/pdo_con_inc.php');	
	foreach ($filen as $this_line) {
		if (!(strpos($this_line, '//') !== false) && !(strpos($this_line, 'pdo') !== false)) {
			$this_line = preg_replace('/\s/', '', $this_line);
			$this_line = str_replace('"', '', $this_line);
			$this_line = str_replace(';', '', $this_line);
			$this_var = substr($this_line, stripos($this_line, '=')+1);
			if (strpos($this_line, '$servername') !== false) {
				$servername = $this_var;
			} else if (strpos($this_line, '$db_name') !== false) {
				$db_name = $this_var;
			} else if (strpos($this_line, '$db_username') !== false) {
				$db_username = $this_var;
			} else if (strpos($this_line, '$db_password') !== false) {
				$db_password = $this_var;
			}
		}
	}
} catch (E_WARNING $e) {
	echo '"include/pdo_con_inc.php" is missing';
}

// ******************************  Testmal:
// $test->start('Testname');
// 	// Test here...
// 	// Response:
// 	if () {
// 		$test->response_error('Error message');
// 	} else {
// 		$test->response_ok('OK message');
// 	}
// $test->end();

// ******************************  Tester:

$test->start('Database Connection');
	try {
		$pdo = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);
		$test->response_ok('Connection established');
	} catch (PDOException $e) {
		$test->response_error('Failed to connect to DB');
	}
$test->end();



$test->start('Insert new user');
	$firstname = $test->getlstr(5);
	$lastname = $test->getlstr(5);
	$email = $test->getlstr(12).'@'.$test->getlstr(5).'.'.$test->getlstr(2);
	$email_false = $test->getlstr(12).'@'.$test->getlstr(5).'.'.$test->getlstr(2);
	$pwd = $test->getlstr(20);
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	// Testing function:
	try {
		$signup->insert_new_user($firstname, $lastname, $email, $hashedPwd);
	} finally {
	

	// Verefying response:
	$user = $test->fetch_user_by_email($email);
	if (empty($user)) {
		$test->response_error('Failed');
	} else {
		$user_id_to_delete = $user['user_ID'];
		$newuser = true;
		$test->response_ok('OK');
	}
$test->end();



$test->start('Fetch user by ID');
	// Testing function:
	try {
		$this_response = $usr->fetch_user_by_id($user['user_ID']);
	} finally {
	

	// Verefying response:
	$user = $test->fetch_user_by_email($email);
	if (!empty(array_diff($this_response, $user))) {
		$test->response_error('Failed');
	} else {
		$test->response_ok('OK');
	}
$test->end();

$test->start('Fetch user by Email');
	// Testing function:
	try {
		$this_response = $signup->fetch_user_by_email($email);
	} finally {
	

	// Verefying response:
	$user = $test->fetch_user_by_email($email);
	if (!empty(array_diff($this_response, $user))) {
		$test->response_error('Failed');
	} else {
		$test->response_ok('OK');
	}
$test->end();




$test->start('Check available email');
	// Testing function:
	try {
		$this_response = $signup->check_available_email($email);
		$this_negative_response = $signup->check_available_email($email_false);
	} finally {
	

	// Verefying response:
	if ($this_response or !$this_negative_response) {
		$test->response_error('Failed');
	} else {
		$test->response_ok('OK');
	}
$test->end();




$test->start('Update user');
	$user = $test->fetch_user_by_email($email);
	$new_firstname = $test->getlstr(5);
	$new_lastname = $test->getlstr(5);
	$new_email = $test->getlstr(12).'@'.$test->getlstr(5).'.'.$test->getlstr(2);
	$new_pwd = $test->getlstr(20);
	$new_hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	// Testing function:
	try {
		$signup->update_user($new_firstname, $new_lastname, $new_email, $new_hashedPwd, $user_id_to_delete);
	} finally {
		
	// Verefying response:
	$new_user = $test->fetch_user_by_id($user_id_to_delete);
	if (($new_user['user_firstname'] == $new_firstname)
		&& ($new_user['user_lastname'] == $new_lastname)
		&& ($new_user['user_email'] == $new_email)
		&& ($new_user['user_pwd'] == $new_hashedPwd)) {
		$test->response_ok('OK');
	} else {
		$test->response_error('Failed');
	}
$test->end();



// *************************************************************** Last test

$test->start('Delete user');
	if (!$newuser) { 
		$test->response_failed_pre_requirement('"Insert new user" is required to succeed for this test to run');
	}
	else {
		// Testing function:
		try {
			$signup->delete_user((Int)$user_id_to_delete);
		} finally {

		// Verefying response:
		if (!empty($test->fetch_user_by_id($user_id_to_delete))) {
			$test->response_error('Failed');
		} else {
			$test->response_ok('OK');
		}
	}
$test->end();

}}}}}}
}?>



</table>
</body>
</html>

