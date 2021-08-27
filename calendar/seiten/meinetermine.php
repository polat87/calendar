<?php

$link = mysqli_connect("localhost",	"root", 	"", 		"terminkalender");
mysqli_query($link, "SET names utf8");
$result = mysqli_query($link, "select * from termine order by Datum desc, Uhrzeit desc");

echo 
"<center><h1>Meine Termine</h1>
<table>
<tr>
	<th>Datum</th>
	<th>Uhrzeit</th>
	<th>Beschreibung</th>
	<th>ändern</th>	
	<th>löschen</th>
	</tr>";

while($datensatz = mysqli_fetch_array($result))
{
	echo 
	"<tr>
	<td>".$datensatz["Datum"]."</td>
	<td>".$datensatz["Uhrzeit"]."</td>
	<td>".$datensatz["Beschreibung"]."</td>
	<td>
	<a href='?seite=edit_confirm&TNR=".$datensatz["TNR"]."&Datum=".$datensatz["Datum"]."
	&Uhrzeit=".$datensatz["Uhrzeit"]."&Text=".$datensatz["Beschreibung"]."'>
	<img src='img/pen.png' class='edit'></a>
	</td>
	<td>
	<a href='?seite=delete_confirm&TNR=".$datensatz["TNR"]."'>
	<img src='img/delete.png' class='delete'></a>
	</td>
	
	</tr>";
}
echo "</table>";
echo "	<a href='?seite=terminneu'>
	<img src='img/plus.png' class='delete'></a>";


mysqli_close($link);

?>

