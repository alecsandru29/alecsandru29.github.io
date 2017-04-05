<html>
<head>
<link rel="icon" type="image/png" href="image/singup.png">
<link rel="stylesheet" type="text/css" href="css/singup.css">
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
   
   if($v==0)
   {
	   $id=7 . "." . $nume . "." . $prenume;
	   if($sex=="masculin")
		echo("<p> Salut ".$prenume.", ai fost inregistrat cu username-ul ".$id);
	   else  
		echo("<p> Salut ".$prenume.", ai fost inregistrata cu username-ul ".$id);
	   
   }
?>
</body>
</html>