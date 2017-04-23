<html>
<head>
<link rel="icon" type="image/png" href="image/login.png">
<link rel="stylesheet" type="text/css" href="css/userdata.css">
<title>Userdata</title>
<script type="text/javascript" src="functii.js"></script>
</head>
<body>
<?php
	
	$username=$_REQUEST["username"];
	$password=$_REQUEST["password"];
	$v=0;
	$ok=0;
	if (!$username) 
	{
		$v=1;
	}
	if(!$password)$v=1;
	if (	  !preg_match("/1/", $password)&& !preg_match("/2/", $password)&& !preg_match("/3/", $password)
		&& !preg_match("/4/", $password)&& !preg_match("/5/", $password)&& !preg_match("/6/", $password)
		&& !preg_match("/7/", $password)&& !preg_match("/8/", $password)&& !preg_match("/9/", $password)
		&& !preg_match("/0/", $password))$v=1;
	//conectare la baza de date
	if($v==1){echo("Nu esti hacker.");}else{
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
	else echo("Nu esti hacker.");
	}
	if($ok==0){echo("Erori diverse.");}else
	{
		echo("<div class=\"log_win\"> <div class=\"tt\">");
		echo("<p> Salut ".$nume." ".$prenume." </p>");
		$nrobiecte = mysql_query("SELECT * from dataleg where IdUser='{$id}'");
		$nrcat = mysql_num_rows(mysql_query("SELECT distinct IdCategorie as nrcat from dataleg where IdUser='{$id}'"));
		echo ("<p>Ai ".mysql_num_rows($nrobiecte)." obiecte impartite in ".$nrcat." categorii.</p><br></div>");
		
		$result = mysql_query("SELECT * FROM obiect join dataleg on obiect.Id=dataleg.IdObiect where IdUser='{$id}'");
		if (mysql_num_rows($result) > 0) 
		{
			?>
			<div class="tt">
			<div class="tl">
			<p>
			<table id="tabelpersonal">
					Obiecte personale
					<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for objects.."><br>
					
					<tr>
					<th>Id</th>
					<th>Nume obiect</th>
					<th>Valoare</th>
					<th>Material</th>
					<th>Culoare</th>
					<th>Categorie</th>
				</tr>
			<?php
			while($row = mysql_fetch_assoc($result)) 
			{
				echo "<tr>";
				$ido=$row["IdObiect"];
				$roww = mysql_fetch_assoc(mysql_query("SELECT * FROM categorie where IdObiect='{$ido}'"));
				echo ("<td>".$row["IdObiect"]."</td><td>".$row["Nume"]."</td><td>" . $row["Valoare"]. "</td><td>" . $row["Material"]."</td><td>".$row["Culoare"]."</td><td>" . $roww["Nume"]."</td>");
				echo "</tr>";
			}
			echo("</table>");
			?>
			<input type="text" id="delete" placeholder="Id">
			<button onclick="myDelete()">Sterge elementul</button><br>
			</p>
			</div>
			<?php	
		}else 
		{
			?>
			<div class="tt">
			<div class="tl">
			<p>Nu ai obiecte personale !</p>
			</div>
			<?php
			
		}
		
		$resultt = mysql_query("SELECT * FROM userdata join dataleg on userdata.Id=dataleg.IdUser join obiect on dataleg.IdObiect=obiect.Id where Pub=1 and IdUser<60");
		
			?>
			<div class="tr">
			<p>
			<table id="tabelpublic">
					Obiecte publice
					<input type="text" id="myInputt" onkeyup="myFunctionn()" placeholder="Search for objects.."><br>
					
					<tr>
					<th>Nume obiect</th>
					<th>Valoare</th>
					<th>Material</th>
					<th>Culoare</th>
					<th>Categorie</th>
				</tr>
			<?php
			while($row = mysql_fetch_assoc($resultt)) 
			{
				echo "<tr>";
				$ido=$row["IdObiect"];
				$roww = mysql_fetch_assoc(mysql_query("SELECT * FROM categorie where IdObiect='{$ido}'"));
				echo ("<td>".$row["Nume"]."</td><td>" . $row["Valoare"]. "</td><td>" . $row["Material"]."</td><td>".$row["Culoare"]."</td><td>" . $roww["Nume"]."</td>");
				echo "</tr>";
			}
			echo("</table>");	
		echo("</div></div></div></div>");
	}
?>
</body>
</html>