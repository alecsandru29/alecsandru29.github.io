 <?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="css/editare.css">
<title>Stergere</title>
</head>
<body>
<div class="log_win">
	
	<?php
	
	$username=$_SESSION['username'];
	$password=$_SESSION['password'];
	
	$host="localhost";
	$user="root";
	$password1="";
	$con=mysql_connect($host,$user,$password1);
	if(!$con) 
	{
		die('<p>Not connect!</p><br>');
	}
	$bd_selected=mysql_select_db("dulapp", $con);
	if(!$bd_selected)
	{
		die("<p>Cant connect to database!</p><br>");
	}
	$logdata= mysql_query("SELECT * from logdata where username='{$username}' and password='{$password}'");
	if(mysql_num_rows($logdata) == 1)
	{
		$row = mysql_fetch_assoc($logdata);
		$id = $row["Id"];
		mysql_query("DELETE FROM userdata WHERE Id = '{$id}'");
		mysql_query("DELETE FROM logdata WHERE Id = '{$id}'");
		$row=mysql_fetch_assoc(mysql_query("SELECT * from dataleg where IdUser='{$id}'"));
		$id = $row["IdObiect"];
		mysql_query("DELETE FROM logdata WHERE IdObiect = '{$id}'");
		mysql_query("DELETE FROM lspecs WHERE Id = '{$id}'");
		mysql_query("DELETE FROM categorie WHERE Id = '{$id}'");
		mysql_query("DELETE FROM obiect WHERE Id = '{$id}'");
		
	}
	?>
	<p>Cont Sters</p>
	<form action="/DulApp/index.php" method="post">
		<input type="submit" value="Pagina principala">
	</form>
	</div>
	<div id="help" >
		<form action="/DulApp/help.html" method="post">
		<input type="image" src="image/help.png" alt="Submit"  width="48" height="48">
		</form>
</div>
</body> 
</html>