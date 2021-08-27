<?php

require('database.php'); 
require('day.php');

if(isset($_GET["mon"]))
{
	new Calendar($_GET["year"], $_GET["mon"]);	
}else
{
	new Calendar(0, 0); // aktueller Monat
}

class Calendar
{
	// todays Date
	protected $today;
	protected $count_elements = 0;
	protected $current_month = false;
	protected $db;
	protected $termine = array();
	protected $holidays = array();
	
	function initHolidays($year, $current_month)
	{
		$aHolidayList = [
			'01.01.' => 'Neujahr',
			'06.01.' => 'Hl. drei Könige',
			'E+0'    => 'Ostersonntag',
			'E+1'    => 'Ostermontag',
			'01.05.' => 'Staatsfeiertag',
			'E+39'   => 'Christi Himmelfahrt',
			'E+50'   => 'Pfingstmontag',
			'E+60'   => 'Fronleichnam',
			'15.08.' => 'Maria Himmelfahrt',
			'26.10.' => 'Nationalfeiertag',
			'01.11.' => 'Allerheiligen',
			'08.12.' => 'Maria Empfängnis',
			'24.12.' => 'Heilig Abend',
			'25.12.' => 'Christtag',
			'26.12.' => 'Stefanitag',
			'31.12.' => 'Silvester'
		 ];

		date_default_timezone_set('Europe/Berlin');
		$dtEaster = new DateTime();
		$year = $year==0 ? 'Y' : $year;
		$year = $dtEaster->format($year);
		$dtEaster = $dtEaster->setTimestamp( easter_date($year) );
		$format = 'Y.m.d';

		foreach ($aHolidayList as $dateExpr => $desc) {
			if ( strpos($dateExpr, 'E') === 0 ) {
				$dateExpr = ltrim($dateExpr, 'E');
				$dtCurr = clone $dtEaster;
				$this->holidays[$desc] = $dtCurr->modify($dateExpr.' day')->format($format);
			} else {
				$this->holidays[$desc] = (new DateTime($dateExpr.$year))->format($format);
			}
		}

		foreach ($this->holidays as $name => $date)
		{			
			$mon = substr($date, 5, 2);
			
			if($current_month != $mon)
			{
				unset($this->holidays[$name]);
			}
			
		}	
		
	}
	
	function __construct($year, $next)
	{
		if($next == 0)
		{
			$this->today = new Day(date("Y"), date("m"), date("d"));	
			$this->current_month = true;	
		}
		else
		{
			$this->today = new Day($year, $next,1);	
			if(date("m") == $next)
			$this->current_month = true;
		}
		
		if(isset($_SESSION["eingeloggt"]))
		{
			$db = new Database("localhost", "terminkalender", "root", "");
			$db->createConnection();
			$von = $this->today->getYear()."-".$this->today->getMon()."-01";
			$bis = $this->today->getYear()."-".$this->today->getMon()."-".$this->today->getnumDays();
			$this->termine = $db->termineMonat($von, $bis);			
		}
		
		$this->initHolidays($year, $this->today->getMon());
		$this->printCalendar();			
	}
	
	function printCalendar()
	{
		$pre_m = $this->today->getMon()-1;
		$pre_y = $this->today->getYear();
		$post_m = $this->today->getMon()+1;
		$post_y = $this->today->getYear();
		
		if($pre_m == 0) {$pre_m = 12; $pre_y-=1;}
		if($post_m == 13) {$post_m = 1; $post_y+=1;}

		echo "<div><a href='?seite=calendar&year=$pre_y&mon=$pre_m'> <img src='img/left_arrow.png' class='arrow'> </a>";					
		echo "<a href='?seite=calendar&year=$post_y&mon=$post_m'> <img src='img/right_arrow.png' class='arrow'> </a></div>";
		echo "<div class='month_name'>".$this->today->getMonthName(). " " .$this->today->getYear() . "</div>";
		
		echo "<div class='wdays'>
			  <div class='wday'>MON</div>
			  <div class='wday'>TUE</div>
			  <div class='wday'>WED</div>
			  <div class='wday'>THU</div>
			  <div class='wday'>FRI</div>
			  <div class='wday'>SAT</div>
			  <div class='wday'>SUN</div> </div><div class='all_days'>";

		$pre_days = 0;
		$totalshow = 42;
		$firstWday = new Day(date("Y"), $this->today->getMon(), 1);

		if($firstWday->getWeekday() != 1)
			$pre_days = $firstWday->getWeekday()-1;
			
		for($i=0; $i < $pre_days; $i++, $totalshow--)
		{
			echo "<div class='cal_day'></div>";
		}

		$this->termine = array_reverse($this->termine, true);
		
		for($i = 1; $i <= $this->today->getnumDays(); $i++, $totalshow--)
		{
			echo "<div class='cal_day'>";
			
			$date = date_create($this->today->getYear()."-".$this->today->getMon()."-".$i);			
			$date = date_format($date, "Y-m-d");
			
			if($this->termine == null){
				if(date("d") == $i && $this->current_month == true)
					echo "<div><a class='cal_day_num kal_aktueller_tag' href=''>$i</a></div>";			
				else
					echo "<div><a class='cal_day_num' href=''>$i</a></div>";
			}
			else{
				if(date("d") == $i && $this->current_month == true)
					echo "<div><a class='cal_day_num kal_aktueller_tag' href='?seite=tagesansicht&Datum=".$date."'>$i</a></div>";			
				else
					echo "<div><a class='cal_day_num' href='?seite=tagesansicht&Datum=".$date."'>$i</a></div>";
			}

			foreach ($this->holidays as $name => $date)
			{
				$tag = substr($date, 8, 2);
				if($i == $tag){
					echo "<div class='kal_feiertag'>$name</div>";						
				}
			}
			
			foreach($this->termine as $key => $value)
			{		
				$rest = substr($value["Datum"], 8, 9);	
				if($i == $rest)
				{
					$text = substr($value["Uhrzeit"], 0, 5);
					$text.= " ".$value["Beschreibung"];
					echo "<div class='cal_termin'><a href='?seite=tagesansicht&TNR=".$value["TNR"]."&Datum=".$value["Datum"]."'>".$text. "</a></div>";				
				}					
			}
			
			echo "</div>";
		}

		for($i = 1; $i <= $totalshow; $i++)
		{
			echo "<div class='cal_day'></div>";			
		}	
		
		echo "<div class='all_days'>";
	}
}
?>
