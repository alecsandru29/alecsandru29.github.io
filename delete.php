 <html>
<head>
<link rel="icon" type="image/png" href="image/icon.png">
<!--<link rel="stylesheet" type="text/css" href="css/login.css">-->
<title>Delete</title>
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
		$result = mysql_query("SELECT * FROM obiect join dataleg on obiect.Id=dataleg.IdObiect where IdUser='{$id}'");
		while($row = mysql_fetch_assoc($result)) 
			{
				echo("<form action=\"\">");
				echo("<input type=\"checkbox\" >".$row["Nume"]."<br>");
			}	
	}
?>
</form>
</body>
</html>