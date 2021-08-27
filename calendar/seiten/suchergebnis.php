<?php
require('php/database.php'); 
$beschreibung = $_POST["beschreibung"];
$db = new Database("localhost", "terminkalender", "root", "");
$db->createConnection();
$result = $db->textSuche($beschreibung);

echo "<span class='success'>Suchergebnis</span><br><br>";
echo 
"<table>
<tr>
	<th>Datum</th>
	<th>Uhrzeit</th>
	<th>Beschreibung</th>
	<th></th>	
	</tr>";

foreach($result as $datensatz)
{
	echo 
	"<tr>
	<td>".$datensatz["Datum"]."</td>
	<td>".$datensatz["Uhrzeit"]."</td>
	<td>".$datensatz["Beschreibung"]."</td>
	<td>
	<a href='?seite=tagesansicht&TNR=".$datensatz["TNR"]."&Datum=".$datensatz["Datum"]."'>
	<img src='img/pen.png' class='edit'></a>
	</td>
	</tr>";
}
echo "</table>";
?>

