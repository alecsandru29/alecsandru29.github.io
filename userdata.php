<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="css/userdata.css">
<title>Dulapuri</title>
<script type="text/javascript" src="functii.js"></script>
</head>
<body>
<div id="id"></div>
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
		
		echo("<p> Salut ".$nume." ".$prenume." </p>");
		$nrobiecte = mysql_query("SELECT * from dataleg where IdUser='{$id}'");
		$nrcat = mysql_num_rows(mysql_query("SELECT distinct IdCategorie as nrcat from dataleg where IdUser='{$id}'"));
		echo ("<p>Ai ".mysql_num_rows($nrobiecte)." obiecte impartite in ".$nrcat." categorii.</p></div>");
		
		//dulap 1
		$result = mysql_query("SELECT * FROM obiect join dataleg on obiect.Id=dataleg.IdObiect join 
		specs on specs.IdObiect=dataleg.IdObiect where IdUser='{$id}' and Dulap='{$pagina}'");
		if (mysql_num_rows($result) > 0) 
		{
			$par=mysql_num_rows($result);
			?>
			
			<?php 
			if($pagina==1)echo("<p>Primul dulap </p><br>");
			else if($pagina==2)echo("<p>Al doilea dulap </p><br>");
				 else echo("<p>Al treilea dulap </p><br>");
			?>
			<div id="cifre">
			<div id="numar" >
			<form action="/DulApp/userdata.php" method="post">
				<input type="hidden" name="pagina" value=1>
				<input type="image" src="image/1.png" alt="Submit"  width="50" height="50">
				</form>
			</div><div id="numar" >
			<form action="/DulApp/userdata.php" method="post">
				<input type="hidden" name="pagina" value=2>
				<input type="image" src="image/2.png" alt="Submit"  width="50" height="50">
				</form>
			</div><div id="numar" >
			<form action="/DulApp/userdata.php" method="post">
				<input type="hidden" name="pagina" value=3>
				<input type="image" src="image/3.png" alt="Submit"  width="50" height="50">
				</form>
			</div>
			</div><br>
			<div class="tl">
			<table id="tabelpersonal1">
			<?php
			echo "<tr>";
			$inti=0;$intii=0;
			while($row = mysql_fetch_assoc($result)) 
			{
				$inti++;
				$intii++;
				$ido=$row["IdObiect"];
				$roww = mysql_fetch_assoc(mysql_query("SELECT * FROM categorie where IdObiect='{$ido}'"));
				$rrow = mysql_fetch_assoc(mysql_query("SELECT * FROM specs where IdObiect='{$ido}'"));
				echo ("<td onclick=\"obiect(".$row["Id"].")\">
				<div id=\"id".$row["Id"]."\"  
				style=\"visibility: hidden; position:fixed; top:200px; left:575px;background-color:#4CAF50;border-radius: 7px;height:300px; width:200px;text-align: left;z-index:15;
				 font-size:16px;font-weight: bold; color:white;\">"
				."Id: ".$row["Id"]."<br>Nume: ".$row["Nume"]."<br>Culoare: ".$row["Culoare"]."<br>Material: ".$row["Material"]."<br>Valoare: ".$row["Valoare"]."<br>Categorie: ".
				$roww["Nume"]."<br>Data adaugare: ".$rrow["data_adaugare"]."<br>Specificatii: ".$rrow["Descriere"].
				"</div> 
				</td>");
				//  <div id=\"id".$row["Id"]."\"  style=\"visibility: hidden;\">".$row["Nume"]."</div>  
				if($inti==2)
				{
					echo "</tr>";
					if($par/6>=$intii)
					echo"<tr>";
					$inti=0;
					}
			}
			echo("</table>");
			?>
			<div id="del">
			<input type="text" id="delete" placeholder="Id">
			<button onclick="myDelete()">Sterge elementul</button>
			</div>
			<?php	
		}else 
		{
			?>
			<div class="tl">
			<p>Nu ai obiecte personale in primul dulap!</p>
			<?php
			
		}
		echo("</div>");
		
		// /dulap1
		
			?>
			<div id="add">
			<button  class="button" onclick="adaugare()" >Adauga obiect</button>
			<form action="/DulApp/publice.php" method="post">
				<input type="hidden" name="pagina" value=1>
				<input class="button" type="submit" value="Pagina publica">
			</form>
			<form action="/DulApp/adaugare.php" method="post" id="adaugare" style="visibility:hidden;">
				<input type="text" name="nume_obiect" id="nume_obiect" placeholder="Nume obiect" required>
				<input type="text" name="valoare" id="valoare" placeholder="Valoare" required><br>
				<input type="text" name="material" id="material"  placeholder="Material" required>
				<input type="text" name="culoare" id="culoare" placeholder="Culoare" required><br>
				<select name="categorie" id="categorie">
					<option value="c1" selected>Haine</option>
					<option value="c2" >Bijuterii</option>
					<option value="c3" >Sport</option>
					<option value="c4" >Mancare</option>
					<option value="c5" >Cosmetice</option>
					<option value="c6" >Papetarie</option>
				</select>
				<select name="dulap" id="dulap">
					<option value="d1" selected>Dulapul I</option>
					<option value="d2" >Dulapul II</option>
					<option value="d3" >Dulapul III</option>
				</select><br>
				<input type="text" name="descriere" id="descriere" placeholder="Descriere" style="height:80px;" maxlength="200">
				<input class="button" type="submit" value="Adaugare"><br>
			</form>
			</div>
			<?php
		
	}
?>
<div id="help" >
		<form action="/DulApp/help.html" method="post">
		<input type="image" src="image/help.png" alt="Submit"  width="48" height="48">
		</form>
</div>
</body>
</html>