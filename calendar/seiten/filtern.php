<form action='?seite=suchergebnis' method='post'><br>
	Suchen nach: <input type='text' name='beschreibung' /><br><br>
	<button type='submit'>Suchen</button>
</form>


<?php

if(isset($_POST["benutzer"]) && isset($_POST["kennwort"]))
{		
	if($_POST["benutzer"] == "a" && $_POST["kennwort"] == "a")
	{
		$_SESSION["eingeloggt"] = true;
		
		# Kopfzeilen ändern
		header("Location: ?seite=mycalender"); # Weiterleiten zur Verwaltung
		exit; # PHP - Programm Ende
	}
	else
	{
		echo "<div style='color:red'>Falsche Eingabe</div>";
	}	
}
?>