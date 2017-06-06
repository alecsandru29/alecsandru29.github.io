<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="css/admin.css">
<title>Pagina admin</title>
<script type="text/javascript" src="functii.js"></script>
</head>
<body>
<div id="back">
<form action="/DulApp/Login.php" method="post" >
		<input type="hidden" name="r" value=1>
		<input type="image" src="image/back.png" alt="Submit"  width="48" height="48">
</form>		
</div>
<div class="log_win">
<?php
	$pagina=$_REQUEST["pagina"];
	$username=$_SESSION["username"];
	$password=$_SESSION["password"];
	$id_user=$_REQUEST['id'];
	$v=0;
	$ok=0;
	if (!$username) 
	{
		$v=1;
	}
	if(!$password)$v=1;
	if (!preg_match("/1/", $password)&& !preg_match("/2/", $password)&& !preg_match("/3/", $password)
		&& !preg_match("/4/", $password)&& !preg_match("/5/", $password)&& !preg_match("/6/", $password)
		&& !preg_match("/7/", $password)&& !preg_match("/8/", $password)&& !preg_match("/9/", $password)
		&& !preg_match("/0/", $password))$v=1;
	//conectare la baza de date
	if($v==1){echo("<p>Nu esti hacker.</p>");}
	else{
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
	{ if($id_user==0) ///daca nu a fost selectat niciun user, pagina standard
		{
		?>
		<div class="tl">
		
			<p>Obiecte publice</p><br>
		<form action="/DulApp/admin.php" method="post">
		<input type="hidden" name="pagina" value=1>
		<input type="text" name="id" id="id" placeholder="Cauta un user..." required>
		<input type="submit" value="Vezi toate informatiile"><br>
		</form>
		</div>
		<div class="tr"> 
		<?php
		//afisarea obiectelor
		$resultt = mysql_query("SELECT * FROM userdata join dataleg on userdata.Id=dataleg.IdUser join obiect on dataleg.IdObiect=obiect.Id and IdObiect<'{$pagina}'*50 and IdObiect >'{$pagina}'*50-50");
			?>	
			
			<table id="tabelpublic">
					<form action="/DulApp/admin.php" method="post">
						<input type="hidden" name="id" id="id" value=0>
						<input type="number" name="pagina" min="1" max="12" required value=<?php echo $pagina; ?>	>
						<input class="button" type="submit" value="Pagina" style="width:auto;">
					</form>
						<input type="text" id="myInputt" onkeyup="myFunctionn()" placeholder="Cauta obiecte ...">
					<tr>
					<th>Nume obiect</th>
					<th>Valoare</th>
					<th>Material</th>
					<th>Culoare</th>
					<th>Categorie</th>
					<th>Detinator</th>
				</tr>
			<?php
			while($row = mysql_fetch_assoc($resultt)) 
			{
				echo "<tr>";
				$ido=$row["IdObiect"];
				$roww = mysql_fetch_assoc(mysql_query("SELECT * FROM categorie where IdObiect='{$ido}'"));
				echo ("<td>".$row["Nume"]."</td><td>" . $row["Valoare"]. "</td><td>" . $row["Material"]."</td><td>".$row["Culoare"]."</td><td>" . $roww["Nume"]."</td><td>" . $row["IdUser"]."</td>");
				echo "</tr>";
			}
			echo("</table>");	
			?>
		</div>
		<?php
		}
	else{
		//pagina cu informatii despre un anumit user
			$rezultat= mysql_query("SELECT * from logdata where Id='{$id_user}'");
			if(mysql_num_rows($rezultat) == 1)
			{
				$row = mysql_fetch_assoc($rezultat);
				$usernameus=$row["Username"];
				$userdata=mysql_query("SELECT * from userdata where id='{$id_user}'");
				$row = mysql_fetch_assoc($userdata);
				$nume=$row["Nume"];
				$prenume= $row["Prenume"];
				$dn=$row["Data_Nastere"];
				$f=strpos($dn,"-");$l=strpos($dn,"-",$f+1);
				$zi=substr($dn,0,$f);$luna=substr($dn,$f+1,$l-$f-1);$an=substr($dn,-4,4);
				?>
				<div class="tl">
				<form action="/DulApp/editare4.php" method="post">
				<input type="hidden" name="userId" value=<?php echo $id_user;?>>
				<input type="hidden" name="verifica" value=1>
				<input type="text" name="username" value=<?php echo $usernameus;?> readonly><br>
				<input type="text" name="nume" value=<?php echo $nume;?> required><br>
				<input type="text" name="prenume" value=<?php echo $prenume;?> required><br>
				<p style="width:450px;">Sex : <select name="sex" id="sex">
				<option value="masculin" <?php if($row["Sex"]==1)echo "selected" ;?>>Masculin</option>
				<option value="feminin"  <?php if($row["Sex"]==0)echo "selected" ;?>>Feminin</option>
				</select><br>
				Profilul utilizatorului <select name="pub" id="pub">
				<option value="da" <?php if($row["Pub"]==1)echo "selected" ;?>>va</option>
				<option value="nu" <?php if($row["Pub"]==0)echo "selected" ;?>>nu va</option>
				</select> fi public.<br>
				Data nasterii :	
				<input type="number" name="zi" min="1" max="31" value=<?php echo $zi;?> required>
				<input type="number" name="luna" min="1" max="12" value=<?php echo $luna;?> required>
				<input type="number" name="an" min="1917" max="2003" value=<?php echo $an;?> required></p>
				<input type="password" name="password1" placeholder="Introduceti parola noua"><br>
				<input type="password" name="password2" placeholder="Introduceti parola noua din nou"><br>
				<input type="submit" value="Modificare date">	
				</form>
				<form action="/DulApp/editare4.php" method="post">
				<input type="hidden" name="userId" value=<?php echo $id_user;?>>
				<input type="hidden" name="verifica" value=2>
				<input type="submit" value="Stergere cont">	
				</form>
				</div>
				<?php
				echo("<div class=\"tr\">");
				//toate obiectele lui
				$result = mysql_query("SELECT * FROM obiect join dataleg on obiect.Id=dataleg.IdObiect join specs on specs.IdObiect=dataleg.IdObiect where IdUser='{$id_user}'");
				if (mysql_num_rows($result) > 0) 
				{
					?>
					<div class="tr"><table id="tabeluser"><p>Obiectele utilizatorului</p>
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
				<form action="/DulApp/editare4.php" method="post">
				<input type="text" name="delete" placeholder="Id">
				<input type="hidden" name="userId" value=<?php echo $id_user;?>>
				<input type="hidden" name="verifica" value=3>
				<input type="submit" value="Sterge obiectul"><br>
				<?php	
			}else 
			{
				?>
				<div class="tr">
				<p>Utilizatorul nu are obiecte in dulap!</p>
				<?php
			
			}
			}
			else 
				echo("<p>User-ul cautat nu exista!</p>");
		}

	}
	}
	echo("</div>");
?>
</body>
</html>