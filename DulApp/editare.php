 <html>
<head>
<link rel="icon" type="image/png" href="image/singup.png">
<link rel="stylesheet" type="text/css" href="css/editare.css">
<title>Singup</title>
</head>
<body>
<div class="log_win">
<form action="/DulApp/Login.php" method="post">
	
		<input type="text" name="nume" value="Trifan" required><br>
		<input type="text" name="prenume" value="Alexandru" required><br>
		<input type="hidden" name="username" value="10001.Trifan.Alexandru">
		<input type="hidden" name="password" value="trifan4444">
		<p>Sex : <select name="sex" id="sex">
			<option value="masculin" selected>Masculin</option>
			<option value="feminin">Feminin</option>
		</select><br>
		Profilul dumneavoastra <select name="pub" id="pub">
			<option value="da" selected>va</option>
			<option value="nu">nu va</option>
		</select> fi public.<br>
		Data nasterii :	
		<input type="number" name="zi" min="1" max="31" value="29" required>
		<input type="number" name="luna" min="1" max="12" value="12" required>
		<input type="number" name="an" min="1917" max="2003" value="1995" required></p>
		<input type="password" name="password1" placeholder="Parola" required pattern="(?=.*\d).{7,}"
		 title="Must contain at least one number and at least 7 or more characters"><br>
		<input type="password" name="password2" placeholder="Introduceti parola noua"><br>
		<input type="password" name="password2" placeholder="Introduceti parola noua din nou"><br>
		<input type="submit" value="Modificare date">	
</form>
</div>
</body> 
</html>
