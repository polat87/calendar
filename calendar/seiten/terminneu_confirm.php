<?php

$dat = '';
if(isset($_GET['Datum']))
{
	$dat= $_GET['Datum'];	
}

//echo header('Location: '.$_SERVER['REQUEST_URI']);
$uri = $_SERVER['REQUEST_URI'];
echo "<h1>Neuer Termin</h1>
	<form method='POST'>
		Datum: <br><input type='date' name='datum' value='$dat' readonly /><br><br>
		Uhrzeit: <br><input type='time' name='uhrzeit' /><br><br>
		Text: <br><input type='text' name='text' />	<br>
		<br />
		<button type='submit'>Termin anlegen</button>
	</form>";		


if(isset($_POST["datum"]) && isset($_POST["uhrzeit"]) && isset($_POST["text"]))
{
	$link = mysqli_connect("localhost",	"root", 	"", 		"terminkalender");
	mysqli_query($link, "SET names utf8");

	$datum = $_POST["datum"];
	$uhrzeit = $_POST["uhrzeit"];
	$text = $_POST["text"];
	
	if($datum == "" || $uhrzeit == "" || $text == "")
		echo "<span class='error'>Ungültige Daten.</span>";	
	else
	{
		mysqli_query($link, "insert into termine
							 (Datum, Uhrzeit, Beschreibung)
							 values 
							('$datum', '$uhrzeit', '$text')");
							

		if($link->affected_rows === -1){
			echo "Fehler: ";
			echo $link->error;
		}
		else{
			echo "<span class='success'>Termin wurde angelegt.</span><br>";			
		}
		
		header("Refresh:3");				
//	header('Location: '.$_SERVER['REQUEST_URI']);	
	}
}

?>


