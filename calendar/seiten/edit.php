
<?php
if(isset($_POST["datum"]) && isset($_POST["uhrzeit"]) && isset($_POST["text"]))
{	
	$link = mysqli_connect("localhost",	"root", 	"", 		"terminkalender");
	mysqli_query($link, "SET names utf8");

	$datum = $_POST["datum"];
	$uhrzeit = $_POST["uhrzeit"];
	$text = $_POST["text"];
	$TNR = $_POST["TNR"];
	
	if($datum == "" || $uhrzeit == "" || $text == "")
		echo "<span class='error'>Ungültige Daten.</span>";	
	else
	{
		mysqli_query($link, "update termine set 
							Datum = '$datum',
							Uhrzeit = '$uhrzeit',
							Beschreibung = '$text'
							where TNR = $TNR ");	
							
		if($link->affected_rows === -1){
			echo "Fehler: ";
			echo $link->error;
		}
		else
			echo "<span class='success'>Termin wurde geändert.</span>";
	}
}
?>