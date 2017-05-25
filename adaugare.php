<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="css/editare.css">
<title>Adaugare Obiect</title>
<script type="text/javascript" src="functii.js"></script>
</head>
<body>
<div class="log_win">
<?php

	$username=$_SESSION["username"];
	$password=$_SESSION["password"];
	$numeOb =  $_REQUEST["nume_obiect"];
	$valoare =  $_REQUEST["valoare"];
	$material =  $_REQUEST["material"];
	$culoare =  $_REQUEST["culoare"];
	$categorie =  $_REQUEST["categorie"];
	$dulap =  $_REQUEST["dulap"];
	$descriere=$_REQUEST["descriere"];
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
	if($v==1){echo("<p>Nu esti hacker.</p>");}else{
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
	}
	if($ok==0){echo("<p>Erori diverse.</p>");}else
	{
		$result = mysql_query("select * from obiect order by Id desc LIMIT 1");
		if(!$result)  die('Error querying database.');
		else
		{
			//adaugarea obiectului in baza de date
			$row = mysql_fetch_assoc($result);
			$idOb = $row["Id"]+1;
			if($categorie=="c1") { $categorie=1; $numec="haine";}
			if($categorie=="c2") { $categorie=2; $numec="bijuterii";}
			if($categorie=="c3") { $categorie=3; $numec="sport";}
			if($categorie=="c4") { $categorie=4; $numec="mancare";}
			if($categorie=="c5") { $categorie=5; $numec="cosmetice";}
			if($categorie=="c6") { $categorie=6; $numec="papetarie";}
			if($dulap=="d1") $dulap=1;
			if($dulap=="d2") $dulap=2;
			if($dulap=="d3") $dulap=3;
			$zia=date("d");$lunaa=date("m");$ana=date("Y");
			$data=$zia.'.'.$lunaa.'.'.$ana;
			$date=mysql_query("SELECT TO_CHAR (SYSDATE, 'MM.DD.YYYY ') FROM DUAL");
			$add=mysql_query("INSERT INTO dataleg(IdUser, IdObiect, IdCategorie) VALUES ('{$id}','{$idOb}','{$categorie}')");
			$add=mysql_query("INSERT INTO obiect (Id, Nume, Culoare, Material, Valoare, IdCat) VALUES ('{$idOb}','{$numeOb}','{$culoare}','{$material}','{$valoare}','{$categorie}')");
			$add=mysql_query("INSERT INTO categorie(Nume, IdObiect, IdCategorie) VALUES ('{$numec}','{$idOb}','{$categorie}')");
			$add=mysql_query("INSERT INTO specs(IdObiect, IdPrev, Descriere, data_adaugare, Dulap) VALUES ('{$idOb}','0','{$descriere}','{$data}','{$dulap}')");

			echo("<p>Obiect adaugat cu succes!</p>");
		}
	}
		?>
	<form action="/DulApp/userdata.php" method="post">
		<input type="hidden" value="1" name="pagina">
		<input type="submit" value="Obiecte">
	</form>
	</div>

</form>
</body>
</html>