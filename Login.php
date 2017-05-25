<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="css/login2.css">
<title>Login</title>
<script type="text/javascript" src="functii.js"></script>
</head>
<body>
<?php
	
	$r = $_REQUEST["r"];
	if($r==1)
	{
		$username=$_SESSION['username'];
		$password=$_SESSION['password'];
	}
	else
	{
		$_SESSION['username'] = $_REQUEST["username"];
		$_SESSION['password'] = $_REQUEST["password"];
		$username=$_SESSION['username'];
		$password=$_SESSION['password'];
	}
	$r=0;
	$pok=0;
	$v=0;
	if (!$username) 
	{
		echo("<p>Nu ai introdus username-ul !</p><br>");
		$v=1;
	}
	if(!$password)$pok=1;
	if (	  !preg_match("/1/", $password)&& !preg_match("/2/", $password)&& !preg_match("/3/", $password)
		&& !preg_match("/4/", $password)&& !preg_match("/5/", $password)&& !preg_match("/6/", $password)
		&& !preg_match("/7/", $password)&& !preg_match("/8/", $password)&& !preg_match("/9/", $password)
		&& !preg_match("/0/", $password))$pok=1;
	if($pok==1){echo("<p>Parola este gresita !</p><br>");$v=1;}
	//conectare la baza de date
	if($v==1){echo("<p>Date introduse gresit</p><br>");}else{
	$host="localhost";
	$user="root";
	$password1="";
	$con=mysql_connect($host,$user,$password1);
	if(!$con) {
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
		$userdata=mysql_query("SELECT * from userdata where id='{$id}'");
		$row = mysql_fetch_assoc($userdata);
		echo("<div class=\"log_win\"><div class=\"t\">");
		
		if($id == -723) {
			?>
			<div class="text"> Salut admin! </div><br>
			<form action="/DulApp/admin.php" method="post">
			<input type="hidden" name="pagina" value=1>
			<input type="hidden" name="id" value=0>
			<input type="submit" value="Pagina admin">
			</form>
			<form action="/DulApp/index.php" method="post">
			<input type="submit" value="Deconectare">
			</form>
			<?php
		}
		else {
		
		echo("<div class=\"text\"> Salut ".$row["Nume"]." ".$row["Prenume"]." </div><br>");
		
		$dn=$row["Data_Nastere"];
		$f=strpos($dn,"-");$l=strpos($dn,"-",$f+1);
		$zi=substr($dn,0,$f);$luna=substr($dn,$f+1,$l-$f-1);$an=substr($dn,-4,4);
		$zia=date("d");$lunaa=date("m");$ana=date("Y");
		$varsta=$ana-$an;if($luna>$lunaa)$varsta=$varsta-1;if($luna==$lunaa and $zi>$zia)$varsta=$varsta-1;
		echo("<div class=\"text\"> Varsta : ".$varsta."</div><br>");
		
		if($row["Sex"]==1)$sex="Masculin"; else $sex="Feminin";
		echo("<div class=\"text\"> Sex : ".$sex."</div><br>");
		
		if($row["Pub"]==1)$pub="este public."; else $pub="nu este public.";
		echo("<div class=\"text\"> Acest cont ".$pub."</div><br>");
		
		$nrobiecte = mysql_query("SELECT * from dataleg where IdUser='{$id}'");
		$nrcat = mysql_num_rows(mysql_query("SELECT distinct IdCategorie as nrcat from dataleg where IdUser='{$id}'"));
		echo ("<div class=\"text\"> Ai ".mysql_num_rows($nrobiecte)." obiecte impartite in ".$nrcat." categorii.</div><br>");
		
		?>
		<form action="/DulApp/userdata.php" method="post">
		<input type="hidden" name="pagina" value=1>
		<input type="submit" value="Obiecte">
		</form>
		<form action="/DulApp/editare.php" method="post">
		<input type="submit" value="Editare date personale">
		</form>
		<form action="/DulApp/index.php" method="post">
		<input type="submit" value="Deconectare">
		</form>
		<button  class="button" onclick="Confirmare()">Stergere Cont</button >
		

		<?php
		echo("</div></div>");
		}
	}
	else echo("
	<div class=\"log_win\">
	<p>Username sau parola gresita .</p><br>
	<form action=\"/DulApp/index.php\" method=\"post\">
		<input type=\"submit\" value=\"Pagina principala\">
	</form>
	</div>");
	}

?>
	
</body>
</html>