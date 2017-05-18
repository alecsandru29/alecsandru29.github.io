<?php session_start(); ?>
<html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="css/login.css">
<title>Login</title>
</head>
<body>
<?php
session_unset();
session_destroy(); 
?>
<div class="log_win">
<form action="/DulApp/Login.php" method="post">
		<input type="hidden" value="0" name="r">
		<input type="text" name="username" placeholder="Username" required><br>
		<input type="password" name="password" placeholder="Password"  required pattern="(?=.*\d).{7,}"
		 title="Must contain at least one number and at least 7 or more characters"><br>
		<input type="submit" value="Login">
		<p>Nu ai cont ? Creeaza unul apasand <a href="Singup.html">aici</a>.</p>
</form>
</div>
</body>
</html>
