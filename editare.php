<?php session_start(); ?>
<html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<link rel="stylesheet" type="text/css" href="css/editare.css">
<title>Editare</title>
</head>
<body>
<div class="log_win">
<form action="/DulApp/editare2.php" method="post">
	
	<?php
	
	$username=$_SESSION['username'];
	$password=$_SESSION['password'];
	
	$host="localhost";
	$user="root";
	$password1="";
	$con=mysql_connect($host,$user,$password1);
	if(!$con) 
	{
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
		$nume=$row["Nume"];
		$prenume= $row["Prenume"];
		$dn=$row["Data_Nastere"];
		$f=strpos($dn,"-");$l=strpos($dn,"-",$f+1);
		$zi=substr($dn,0,$f);$luna=substr($dn,$f+1,$l-$f-1);$an=substr($dn,-4,4);
	}
	?>
		<input type="text" name="username" value=<?php echo $username;?> readonly><br>
		<input type="text" name="nume" value=<?php echo $nume;?> required><br>
		<input type="text" name="prenume" value=<?php echo $prenume;?> required><br>
		<p>Sex : <select name="sex" id="sex">
			<option value="masculin" <?php if($row["Sex"]==1)echo "selected" ;?>>Masculin</option>
			<option value="feminin"  <?php if($row["Sex"]==0)echo "selected" ;?>>Feminin</option>
		</select><br>
		Profilul dumneavoastra <select name="pub" id="pub">
			<option value="da" <?php if($row["Pub"]==1)echo "selected" ;?>>va</option>
			<option value="nu" <?php if($row["Pub"]==0)echo "selected" ;?>>nu va</option>
		</select> fi public.<br>
		Data nasterii :	
		<input type="number" name="zi" min="1" max="31" value=<?php echo $zi;?> required>
		<input type="number" name="luna" min="1" max="12" value=<?php echo $luna;?> required>
		<input type="number" name="an" min="1917" max="2003" value=<?php echo $an;?> required></p>
		<input type="password" name="password" placeholder="Parola" required pattern="(?=.*\d).{7,}"
		 title="Must contain at least one number and at least 7 or more characters"><br>
		<input type="password" name="password1" placeholder="Introduceti parola noua"><br>
		<input type="password" name="password2" placeholder="Introduceti parola noua din nou"><br>
		<input type="submit" value="Modificare date">	
</form>
</div>
</body> 
</html>