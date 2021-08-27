<?php
class Database
{
	protected $host;
	protected $dbname;
	protected $user;
	protected $pwd;
	protected $conn;
	
	function __construct($host, $db, $u, $p)
	{
		$this->host = $host;
		$this->dbname = $db;
		$this->user = $u;
		$this->pwd = $p;
		$this->createConnection();
	}
	
	function createConnection()
	{
		$stmt = "mysql:host=".$this->host.";dbname="."$this->dbname";
		$this->conn = new PDO($stmt, $this->user, $this->pwd);		
	}
	
	function termineMonat($von, $bis)
	{	
		$rows = array();	
		$stmt = "select * from termine WHERE (Datum BETWEEN :von AND :bis)";		

		$antwort = $this->conn->prepare($stmt);	
		$antwort->execute(["von" => $von, "bis" => $bis]);	

		while($row = $antwort->fetch()) {
			$rows[] = $row;  
		}
		
		return $rows;
	}
	
	function tagesAnsicht($datum)
	{
		$rows = array();	
		$stmt = "select * from termine WHERE Datum LIKE '".$datum."'";
		$antwort = $this->conn->prepare($stmt);	
		$antwort->execute();	

		while($row = $antwort->fetch()) {
			$rows[] = $row;  
		}

		return $rows;		
	}
	
	function terminNachNr($TNR)
	{
		$rows = array();	
		$stmt = "select * from termine where TNR='$TNR';";
		$antwort = $this->conn->prepare($stmt);	
		$antwort->execute();	

		return $antwort->fetch();		
	}

	function update($dat, $uhr, $text, $TNR)
	{
		$rows = array();	
		$stmt = "update termine set Datum = '$dat',
							Uhrzeit = '$uhr',
							Beschreibung = '$text'
							where TNR = $TNR;";

		$antwort = $this->conn->prepare($stmt);	
		$antwort->execute();	

		return $antwort->fetch();					
	}
	
	function textSuche($text)
	{
		$rows = array();	
		$stmt = "select * from termine where Beschreibung LIKE '%$text%' order by Datum desc, Uhrzeit desc;";		
		$antwort = $this->conn->prepare($stmt);	
		$antwort->execute();	
		while($row = $antwort->fetch()) {
			$rows[] = $row;  
		}
		
		return $rows;				
	}
	
	function filterMonat($monat)
	{
		$rows = array();	
		$stmt = "select * from termine WHERE DATE_FORMAT(Datum, '%m') = $monat";		
		$antwort = $this->conn->prepare($stmt);	
		$antwort->execute();	
		while($row = $antwort->fetch()) {
			$rows[] = $row;  
		}
		
		return $rows;				
	}
}
?>

