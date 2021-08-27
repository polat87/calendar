<?php
require('php/database.php'); 
$datum = $_GET['Datum'];

$db = new Database("localhost", "terminkalender", "root", "");
$db->createConnection();
$termine = $db->tagesAnsicht($datum);

echo "<div>";
echo "<div id ='head_left' class='month_name'>".date("D", strtotime($datum))."<br>".date("j", strtotime($datum))." ".date("M", strtotime($datum))."</div>";
echo "<div id ='head_right'><a href='?seite=tagesansicht&Datum=$datum'>
	<img src='img/plus.png' class='delete'></a></div>";
echo "<div id='day_left'>";

for($i=0; $i <24; $i++)
{	
	echo "<div class='day_cell'>";
	$hour = "$i.:00";
	if($i < 10) $hour = "0".$hour;
	echo "<div>$hour</div>";

	foreach($termine as $key => $value)
	{
		$stunde = substr($value["Uhrzeit"], 0, 2);	
		if($i == $stunde)
		{
			$text = substr($value["Uhrzeit"], 0, 5);
			$text.= " ".$value["Beschreibung"];
			echo "<div class='day_termin'><a href='?seite=tagesansicht&TNR=".$value["TNR"]."&Datum=".$value["Datum"]."'>".$text. "</a><br></div>";			
			
		}			
	}
	
	echo "</div>";
}

echo "</div>";
echo "<div id='day_right'>";

if(isset($_GET['TNR']))
include('seiten/edit_confirm.php');
else
include('seiten/terminneu_confirm.php');
echo "</div>";
echo "</div>";

?>
