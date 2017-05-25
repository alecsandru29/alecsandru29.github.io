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
		echo ("<p>Ai ".mysql_num_rows($nrobiecte)." obiecte impartite in ".$nrcat." categorii.</p><br></div>");
		
		echo("<div class=\"tt\">");
		echo("<div class=\"tl\">");
		//Primul dulap
		$result = mysql_query("SELECT * FROM obiect join dataleg on obiect.Id=dataleg.IdObiect join 
		specs on specs.IdObiect=dataleg.IdObiect where IdUser='{$id}' and Dulap=1");
		if (mysql_num_rows($result) > 0) 
		{
			?>
			<div class="tl">
			<p>
			<table id="tabelpersonal1">
					Primul dulap
					<input type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Cauta obiecte ..."><br>
					
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
			<?php	
		}else 
		{
			?>
			<div class="tl">
			<p>Nu ai obiecte personale in primul dulap!</p>
			<?php
			
		}
		echo("</div><br>");
		////Dulapul 2
		$result = mysql_query("SELECT * FROM obiect join dataleg on obiect.Id=dataleg.IdObiect join 
		specs on specs.IdObiect=dataleg.IdObiect where IdUser='{$id}' and Dulap=2");
		if (mysql_num_rows($result) > 0) 
		{
			?>
			<div class="tl">
			<p>
			<table id="tabelpersonal2">
					Al doilea dulap
					<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Cauta obiecte ..."><br>
					
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
			<?php	
		}else 
		{
			?>
			<div class="tl">
			<p>Nu ai obiecte personale in al doilea dulap!</p>
			<?php
			
		}
		echo("</div><br>");
		/////Dulapul 3
		$result = mysql_query("SELECT * FROM obiect join dataleg on obiect.Id=dataleg.IdObiect join 
		specs on specs.IdObiect=dataleg.IdObiect where IdUser='{$id}' and Dulap=3");
		if (mysql_num_rows($result) > 0) 
		{
			?>
			<div class="tl">
			<p>
			<table id="tabelpersonal3">
					Al treilea dulap
					<input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Cauta obiecte ..."><br>
					
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
			<?php	
		}else 
		{
			?>
			<div class="tl">
			<p>Nu ai obiecte personale in al treilea dulap!</p>
			<?php
			
		}
		echo("</div><br>");
		if(mysql_num_rows($result) < 25)
		{
			?>
			<button  class="button" onclick="adaugare()" >Adauga obiect</button>
			<form action="/DulApp/adaugare.php" method="post" id="adaugare" style="visibility:hidden;">
				<input type="hidden" name="username" value="<?php echo $username ?>">
				<input type="hidden" name="password" value="<?php echo $password ?>">
				<input type="text" name="nume_obiect" id="nume_obiect" placeholder="Nume obiect">
				<input type="text" name="valoare" id="valoare" placeholder="Valoare"><br>
				<input type="text" name="material" id="material"  placeholder="Material">
				<input type="text" name="culoare" id="culoare" placeholder="Culoare"><br>
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

			<?php
		}
		echo("</div>");
		///tabela publica
		$resultt = mysql_query("SELECT * FROM userdata join dataleg on userdata.Id=dataleg.IdUser join obiect on dataleg.IdObiect=obiect.Id where Pub=1 and IdObiect<'{$pagina}'*50 and IdObiect >'{$pagina}'*50-50");
		
			?>
			<div class="tr">
			<p>
			<table id="tabelpublic">
					Obiecte publice
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