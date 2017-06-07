<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="css/public.css">
<title>Dulapuri</title>
<script type="text/javascript" src="functii.js"></script>
</head>
<body>
<div id="back" >
		<form action="/DulApp/Login.php" method="post">
		<input type="hidden" name="r" value=1>
		<input type="image" src="image/back.png" alt="Submit"  width="48" height="48">
		</form>
</div>
<?php
	
	$username=$_SESSION['username'];
	$password=$_SESSION['password'];
	$pagina=$_REQUEST["pagina"];
	$host="localhost";
	$user="root";
	$password1="";
	$con=mysql_connect($host,$user,$password1);
	if(!$con) {
		die('Not connect!');
	}
	$bd_selected=mysql_select_db("dulapp", $con);
	if(!$bd_selected)
	{
		die("Cant connect to database!");
	}
	$logdata= mysql_query("SELECT * from logdata where username='{$username}' and password='{$password}'");
	if(mysql_num_rows($logdata) == 1)
	{
		$row = mysql_fetch_assoc($logdata);
		$id = $row["Id"];
		$userdata=mysql_query("SELECT * from userdata where id='{$id}'");
		$ok=1;
		$row=mysql_fetch_assoc($userdata);
		$nume=$row["Nume"];
		$prenume=$row["Prenume"];
	}
	else echo("<p>Nu esti hacker.</p>");
	
	if($ok==0){echo("<p>Erori diverse.</p>");}else
	{

		echo("<div class=\"log_win\"> <div class=\"tt\">");
		
		//echo("<div class=\"tl\">");
		
		///tabela publica
		$resultt = mysql_query("SELECT * FROM userdata join dataleg on userdata.Id=dataleg.IdUser join obiect on dataleg.IdObiect=obiect.Id where Pub=1 and IdObiect<'{$pagina}'*50 and IdObiect >'{$pagina}'*50-50");
		
			?>
			<div class="tr">
			<p>Obiecte publice</p>
			<table id="tabelpublic">
					<input type="text" id="myInputt" onkeyup="myFunctionn()" placeholder="Cauta obiecte ...">
					<form action="/DulApp/userdata.php" method="post">
						<input type="number" name="pagina" min="1" max="12" required value=<?php echo $pagina; ?>	>
						<input class="button" type="submit" value="Pagina" style="width:auto;"><br>
					<form>
						
					<tr>
					<th>Nume obiect</th>
					<th>Valoare</th>
					<th>Material</th>
					<th>Culoare</th>
					<th>Categorie</th>
					<th>Nume</th>
				</tr>
			<?php
			while($row = mysql_fetch_assoc($resultt)) 
			{
				echo "<tr>";
				$ido=$row["IdObiect"];
				$roww = mysql_fetch_assoc(mysql_query("SELECT * FROM categorie where IdObiect='{$ido}'"));
				$rrow = mysql_fetch_assoc(mysql_query("SELECT * FROM dataleg where IdObiect='{$ido}'"));
				$pers=$row["Valoare"];
				$nume =	mysql_fetch_assoc(mysql_query("SELECT * FROM userdata where Id	='{$pers}'"));
				echo ("<td>".$row["Nume"]."</td><td>" . $row["Valoare"]. "</td><td>" . $row["Material"]."</td><td>".$row["Culoare"]."</td><td>" . $roww["Nume"]."</td><td>".$nume["Nume"]." ".$nume["Prenume"]."</td>");
				echo "</tr>";
			}
			echo("</table>");	
		echo("</div></div></div></div>");
	}
?>
<div id="help" >
		<form action="/DulApp/help.html" method="post">
		<input type="image" src="image/help.png" alt="Submit"  width="48" height="48">
		</form>
</div>
</body>
</html>
