<html>
<head>
<link rel="icon" type="image/png" href="image/singup.png">
<!--<link rel="stylesheet" type="text/css" href="css/singup.css">-->
<title>Singup</title>
</head>
<body>
<?php 
	$v=0;
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
   $pok=0;
   if(!$password1 || !$password2)$pok=1;
   if($password1!=$password2)$pok=1;
   if (	  !preg_match("/1/", $password1)&& !preg_match("/2/", $password1)&& !preg_match("/3/", $password1)
	   && !preg_match("/4/", $password1)&& !preg_match("/5/", $password1)&& !preg_match("/6/", $password1)
	   && !preg_match("/7/", $password1)&& !preg_match("/8/", $password1)&& !preg_match("/9/", $password1)
	   && !preg_match("/0/", $password1))$pok=1;
   if($pok==1){echo("<p>Parola este gresita !</p>");$v=1;}
   
   //conectare la baza de date
	$host="localhost";
	$user="root";
	$password="";
	$con=mysql_connect($host,$user,$password);
	if(!$con) {
		die('Not connect');
	}
	
	$bd_selected=mysql_select_db("dulapp", $con);
	if(!$bd_selected)
	{
		die("cant connect");
	}

	$result = mysql_query('select * from userdata order by Id desc LIMIT 1');
	
	if(!$result)  die('Error querying database.');
	$ok=1;
	if($v==1)echo("Error");else{
		
		$row = mysql_fetch_assoc($result);
		$id = $row["Id"]+1;
		$datanastere=$zi."-".$luna."-".$an;
		if($sex=="masculin")$sex=1;else $sex=0;
		if($pub=="da")$pub=1;else $pub=0;
		$sql = "INSERT INTO userdata (Nume, Prenume, Data_Nastere , Pub ,Sex ,Id)
		VALUES ('{$nume}', '{$prenume}','{$datanastere}','{$pub}','{$sex}','{$id}')";
		if (!mysql_query($sql,$con ))
		{
			echo "Error: " . $sql . "<br>";
			$ok=0;
		}
		$username=$id.".".$nume.".".$prenume;
		$sql = "INSERT INTO logdata (Id,Username,Password) values ('{$id}','{$username}','{$password1}')";
		if (!mysql_query($sql,$con ))
		{
			echo "Error: " . $sql . "<br>";
			$ok=0;
		}
		if($ok==1){
		if($sex=="1")
			echo("<p> Salut ".$prenume.", ai fost inregistrat cu username-ul ".$username);
		   else  
			echo("<p> Salut ".$prenume.", ai fost inregistrata cu username-ul ".$username);
		}else echo("Error");
	   
	}
	
	
?>
</body>
</html>