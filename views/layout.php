<DOCTYPE html>

<?php session_start(); ?>

<html>

	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	    <style type="text/css">
	        body{ font: 14px sans-serif; }
	        .wrapper{ width: 350px; padding: 20px; }
	    </style>
	</head>

	<header>
		<nav class="navbar navbar-default">
			<ul class="nav navbar-nav navbar-left">
				<?php echo (!isset($_SESSION['user_id']) ? '<li class="menu-item"><a href="/login">Login</a></li>' : '') ?>
				<?php echo (!isset($_SESSION['user_id']) ? '<li class="menu-item"><a href="/register">Register</a></li>' : '') ?>
				<?php echo (isset($_SESSION['user_id']) ? '<li class="menu-item"><a href="/profile">Profile</a></li>' : '') ?>
				<?php echo (isset($_SESSION['user_id']) ? '<li class="menu-item"><a href="/user-uploads">Uploads</a></li>' : '') ?>
			</ul>
		</nav>
	</header>

	<body>
		<?php require_once('routes.php'); ?>
	</body>

</html>