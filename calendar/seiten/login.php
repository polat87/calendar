<form action='?seite=login' method='post'><br>
	Benutzer: <input type='text' name='benutzer' /><br>
	Passwort: <input type='password' name='kennwort' /><br><br>
	<button type='submit'>Anmelden</button>
</form>


<?php

if(isset($_POST["benutzer"]) && isset($_POST["kennwort"]))
{		
	if($_POST["benutzer"] == "user" && $_POST["kennwort"] == "12345")
	{
		$_SESSION["eingeloggt"] = true;
		header("Location: ?seite=calendar"); 
		exit;
	}
	else
	{
		echo "<div class='error'>Ungültige Eingabe</div>";
	}	
}
?>