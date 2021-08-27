<?php
class Day
{
	protected $termine = [];
	protected $year;
	protected $month;
	protected $day;
	protected $numDays;
	protected $weekDay;		

	function __construct($year, $month, $day)
	{
		$this->year = $year;
		$this->month = $month;
		$this->day = $day;
		$this->weekDay = date("N", mktime(0, 0, 0, $month, $day, $year));
		$this->numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	}
	
	function getWeekday() {return $this->weekDay;}
	function getNumDays(){return $this->numDays;}	
	function getYear(){return $this->year;}
	function getMon(){return $this->month;}
	function getDay(){return $this->day;}
	function dayBack()
	{
		echo date('d.m.Y',strtotime("-3 days"));
	}
	
	function isEqualDay($other)
	{
		if($this->day != $other->day)
		return false;
		if($this->month != $other->month)
		return false;
		if($this->year != $other->year)
		return false;
			
		return true;
	}
	
	function getMonthName()
	{
		$dateValue = $this->year."-".$this->month."-".$this->day;
		return date('F', strtotime($dateValue));
	}
		
}
?>