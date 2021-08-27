<?php
if(isset($_POST['delete']))
{
	require('seiten/delete.php'); 
	die();
}
		
if(isset($_GET['TNR']))
{
	$TNR = $_GET['TNR'];				
	$db = new Database("localhost", "terminkalender", "root", "");
	$db->createConnection();
	$termin = $db->terminNachNr($TNR);	
	
	$datalt = $termin['Datum'];
	$uhralt = $termin['Uhrzeit'];
	$textalt = $termin['Beschreibung'];
	
echo "<h1>Termin ändern</h1>
	<form method='POST'>
		Datum: <br><input type='date' name='datum' value='$datalt' /><br><br>
		Uhrzeit: <br><input type='time' name='uhrzeit' value='$uhralt' /><br><br>
		Text: <br><input type='text' name='text' value='$textalt'  />	<br>
		<input type='hidden' name='TNR' value='$TNR' />
		<br />
		<button type='submit' name='change_termin'>Termin ändern</button>
	</form>";	

echo "	<form method='POST'>
		<input type='hidden' name='TNR' value='$TNR' />	
		<input type='hidden' name='delete' value='yes' />	
		<button type='submit' class='delete_button'>Termin löschen</button>
	</form>";	
}
	
if(isset($_POST["datum"]) && isset($_POST["uhrzeit"]) && isset($_POST["text"]))
{
	$datum = $_POST["datum"];
	$uhrzeit = $_POST["uhrzeit"];
	$text = $_POST["text"];
	$TNR = $_POST["TNR"];
	
	if($datum == "" || $uhrzeit == "" || $text == "")
		echo "<span class='error'>Ungültige Daten.</span>";	
	else
	{
			
		$db = new Database("localhost", "terminkalender", "root", "");
		$db->createConnection();
		$db->update($datum, $uhrzeit, $text, $TNR);
		echo "<span class='success'>Termin wurde geändert.</span>";
		header("Refresh:3; url=?seite=tagesansicht&Datum=$datum");				
	}
}
	
?>

