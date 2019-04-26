<?php
session_start();

$userName = "???";
$password = "???";

if (isset($_POST["inputUsername"])) {
	if ($_POST["inputUsername"] == $userName && $_POST["inputPassword"] == $password){
		$_SESSION["logged_in"] = true;
	} else {
		$error = "Incorrect username or password!";
	}
}

if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
	header("Location: page2/index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v3.8.5">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<title>JH · Billede album</title>
    <link rel="icon" href="images/favicon.ico">


	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">


	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>
	<!-- Custom styles for this template -->
	<link href="css/floating-labels.css" rel="stylesheet">
</head>
<body>
	<form class="form-signin" method="POST">
		<div class="text-center mb-4">
			<i class="far fa-images fa-10x"></i>
			<!--<img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">-->
			<h1 class="h3 mb-3 font-weight-normal"><code>JH.</code> billede gallery</h1>
			<p>Hjemmeside for uploading/downloading af billeder.</p>
		</div>

		<?php if (isset($error)): ?>
		<div class="alert alert-danger"><?php echo $error; ?></div>
		<?php endif;?>

		<div class="form-label-group" name="test1">
			<input id="inputUsername" name="inputUsername" type="text" class="form-control" placeholder="Email address" required autofocus>
			<label for="inputEmail">Brugernavn</label>
		</div>

		<div class="form-label-group" name="test2">
			<input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
			<label for="inputPassword">Password</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block">Log in</button>
		<p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2019</p>
	</form>
</body>

</html>
