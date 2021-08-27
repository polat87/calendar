
<?php
if(isset($_POST["delete"]))
{
	$TNR = $_GET["TNR"];
	$link = mysqli_connect("localhost",	"root", 	"", 		"terminkalender");
	mysqli_query($link, "SET names utf8");
	$statement = "delete from termine where TNR='$TNR';";
	$result = mysqli_query($link, $statement);
	
	$datum = $_GET["Datum"];
	echo "<br><span class='error'>Termin wurde gelöscht.</span><br>";
	header("Refresh:3; url=?seite=tagesansicht&Datum=$datum");		
}
?>