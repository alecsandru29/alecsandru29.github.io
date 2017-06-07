 <?php session_start(); ?>
<!DOCTYPE html>
 <html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="css/editare.css">
<title>Editare</title>
</head>
<body>
<div id="back">
<form action="/DulApp/admin.php" method="post" >
		<input type="hidden" name="id" value=0>
		<input type="hidden" name="pagina" value=1>
		<input type="image" src="image/back.png" alt="Submit"  width="48" height="48">
</form>		
</div>
<div class="log_win">
<?php 
	$v=0;
	$verifica=$_REQUEST["verifica"];
	$id_user=$_REQUEST["userId"];
	if($verifica==1) ///actualizare informatii personale user
	{
		$username=$_REQUEST["username"];
		$nume=$_REQUEST["nume"];
		$prenume=$_REQUEST["prenume"];
		$zi=$_REQUEST["zi"];
		$luna=$_REQUEST["luna"];
		$an=$_REQUEST["an"];
		$sex=$_REQUEST["sex"];
		$pub=$_REQUEST["pub"];
		$password1=$_REQUEST["password1"];
		$password2=$_REQUEST["password2"];
	
	if (!$nume) 
	{
	   echo("<p>Nu ai introdus numele !</p>");
	   $v=1;
	}
   if (!$prenume) 
   {
	   echo("<p>Nu ai introdus prenumele !</p>");
	   $v=1;
   }
   $datac=0;
   if (!$zi || !$luna || !$an ||$zi>31||$luna>12 || $an>2003 ||$an<1917) 
   {
		$datac=1;
   }
   if(($luna==4 && $zi==31)||($luna==6 && $zi==31)||($luna==9 && $zi==31)||($luna==11 && $zi==31))
   {
	   $datac=1;
   }
   if(($an%4==0 &&$an%100!=0)||$an%400==0)
   {
	   if($luna==2 && $zi>29)$datac=1;
   }
   else if($luna==2 && $zi > 28 )$datac=1;
   if($datac == 1)
   {
	   echo("<p>Data nasterii este gresita!</p>");
	   $v=1;
   }
   if (!$sex || ($sex!="masculin" && $sex!="feminin")) 
   {
	   echo("<p>Nu ai introdus sex-ul corect!</p>");
	   $v=1;
   }
   if (!$pub || ($pub!="da" && $pub!="nu")) 
   {
	   echo("<p>Nu ai decis daca vrei un cont public sau nu !</p>");
	   $v=1;
   }
     $pok=0;$nul=0;
	if(!$password1 && !$password2)$nul=1;
	if($password1!=$password2)$pok=1;
	if (!preg_match("/1/", $password1)&& !preg_match("/2/", $password1)&& !preg_match("/3/", $password1)
	   && !preg_match("/4/", $password1)&& !preg_match("/5/", $password1)&& !preg_match("/6/", $password1)
	   && !preg_match("/7/", $password1)&& !preg_match("/8/", $password1)&& !preg_match("/9/", $password1)
	   && !preg_match("/0/", $password1)) $pok=1;
	 if($nul==0 && $pok==1){echo("<p>Parolele nu corespund !</p>");$v=1;}
	  //conectare la baza de date
	$host="localhost";
	$user="root";
	$passwordd="";
	$con=mysql_connect($host,$user,$passwordd);
	if(!$con) {
		die('<p>Not connect</p>');
	}
	
	$bd_selected=mysql_select_db("dulapp", $con);
	if(!$bd_selected)
	{
		die("<p>Can't connect</p>");
	}
	$ok=1;
	if($v==1);
	else{
		$logdata= mysql_query("SELECT * from logdata where id='{$id_user}'");
		if(mysql_num_rows($logdata) == 1)
		{
			$row = mysql_fetch_assoc($logdata);
			$datanastere=$zi."-".$luna."-".$an;
			if($sex=="masculin")$sex=1;else $sex=0;
			if($pub=="da")$pub=1;else $pub=0;
			$sql = "UPDATE userdata SET Nume ='{$nume}',Prenume= '{$prenume}',Data_Nastere='{$datanastere}',Pub='{$pub}',Sex='{$sex}' 
			Where Id='{$id_user}'";
			if (!mysql_query($sql,$con ))
			{
				echo "<p>Error: " . $sql . "</p><br>";
				$ok=0;
			}
			$sql = "UPDATE logdata SET password = '{$password1}' where Id='{$id_user}'";
			}
			else{$pok=0; $ok=0;}
			if($ok==1)
			{
				echo("<p> Datele user-ului cu id-ul ".$id_user." au fost modificate .</p>");
			}
			elseif($pok==1){ echo("<p>Error</p>");}

	}
	}
	if($verifica==2) //stergerea unui cont
	{
		$host="localhost";
		$user="root";
		$passwordd="";
		$con=mysql_connect($host,$user,$passwordd);
		if(!$con) {
		die('<p>Not connect</p>');
		}
	
		$bd_selected=mysql_select_db("dulapp", $con);
		if(!$bd_selected)
		{
			die("<p>Can't connect</p>");
		}
		$logdata= mysql_query("SELECT * from logdata where id='{$id_user}'");
		if(mysql_num_rows($logdata) == 1)
		{
			mysql_query("DELETE FROM userdata WHERE Id = '{$id_user}'");
			mysql_query("DELETE FROM logdata WHERE Id = '{$id_user}'");	
			$row=mysql_fetch_assoc(mysql_query("SELECT * from dataleg where IdUser='{$id_user}'"));
			$id = $row["IdObiect"];
			mysql_query("DELETE FROM logdata WHERE IdObiect = '{$id}'");
			mysql_query("DELETE FROM lspecs WHERE Id = '{$id}'");
			mysql_query("DELETE FROM categorie WHERE Id = '{$id}'");
			mysql_query("DELETE FROM obiect WHERE Id = '{$id}'");
			echo("<p>Cont sters!</p>");
		}
	}
	if($verifica==3) //stergerea unui obiect
	{
		$sterg=$_REQUEST["delete"];
		$host="localhost";
		$user="root";
		$passwordd="";
		$con=mysql_connect($host,$user,$passwordd);
		if(!$con) {
		die('<p>Not connect</p>');
		}
	
			$bd_selected=mysql_select_db("dulapp", $con);
		if(!$bd_selected)
		{
			die("<p>Can't connect</p>");
		}
		$obiect=mysql_query("select * from obiect join dataleg on dataleg.IdObiect=obiect.Id where IdObiect='{$sterg}' and IdUser='{$id_user}'");
		if (mysql_num_rows($obiect) > 0) 
		{
			$result = mysql_query("DELETE FROM dataleg where IdUser='{$id_user}' and IdObiect='{$sterg}' ");
			$result = mysql_query("DELETE FROM obiect where Id='{$sterg}' ");
			$result = mysql_query("DELETE FROM specs where IdObiect='{$sterg}' ");
			$result = mysql_query("DELETE FROM categorie where IdObiect='{$sterg}' ");
			echo("<p>Obiectul a fost sters!</p>");
		}
		else echo("<p>Obiectul nu exista!</p>");
	}
	?>
	<div id="help" >
		<form action="/DulApp/help.html" method="post">
		<input type="image" src="image/help.png" alt="Submit"  width="48" height="48">
		</form>
</div>	
</body>
</html>