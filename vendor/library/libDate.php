<?php

	/*
		Library : Date
		Description	: For date manipulation functions .
		Author		: Shajahan Basha Syed

	*/

class libDate{

	var $today;
	var $format = 'Y-m-d H:i:s';

	function __Construct(){
		$this->today = date($this->format);
	}

	function setFormat($format='Y-m-d'){
		$this->format = $format;
		$this->today = date($format);
	}
	function getToday(){
		
		return $this->today;
	}
	function getDay($time,$fulldate=false){
		if($fulldate==true){
			return date('l', strtotime($time));
		} else{
			return date('D', strtotime($time));
		}
	}
	function getForwardDate($date,$no_of_days){

		$date=date_create($date);
		$adddays = "$no_of_days days";
		date_add($date,date_interval_create_from_date_string($adddays));
		return date_format($date,$this->format);

	}
	
	function getForwardDateByCurrentDate($no_of_days){
		return $this->getForwardDate($this->today, $no_of_days);
	}
	
	function getCalculateTime($current_time,$difference){
		return date("Y-m-d H:i:s",strtotime($difference, strtotime($current_time)));
	}



	function dateDifferenceByCurrentDate($toDate){

		return $this->dateDifference($this->today, $toDate);

	}

	function getCalcuatedDate($date,$no_of_days,$period,$format){

		$date=date_create($date);
		$adddays = "$no_of_days $period";
		date_add($date,date_interval_create_from_date_string($adddays));
		return date_format($date,$format);

	}
	
	function convertTimeZone($time, $origin, $target, $format='Y-m-d H:i:s') {
		$date = new DateTime($time, new DateTimeZone($origin));
		$date->setTimezone(new DateTimeZone($target));
		return $date->format($format);
	}
	
	
	function dateDifference($start,$end){

		$start_ts = strtotime($start);
		$end_ts = strtotime($end);

		if($start_ts>$end_ts){
			$diff = $start_ts-$end_ts;
		} else{
			$diff = $end_ts - $start_ts;
		}

		return round($diff / 86400);
	}
	
	function timeDifference($start,$end){

		$start_ts = strtotime($start);
		$end_ts = strtotime($end);

		if($start_ts>$end_ts){
			$diff = $start_ts-$end_ts;
		} else{
			$diff = $end_ts - $start_ts;
		}

		return round($diff / 60);
	}
	
	function checkDayinDays($checkday,$startday,$endday){
	
		$checkday = date('D',strtotime($checkday));
		$startday = date('D',strtotime($startday));
		$endday = date('D',strtotime($endday));
		
		$workingdays = array();
		
		$days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');



		if($startday==$endday){
			$tsi = array_search($startday,$days);
			if($tsi==0){
				$endday = $days[6];
			} else{
				$tei = $tsi-1;
				$endday = $days[$tei];
			}
		}

		$si = array_search($startday,$days);
		$ei = array_search($endday,$days);

		if($si==6){
			
			for($i=0;$i<=$ei;$i++){
				$workingdays[] = $days[$i];		
			}
			
		} else if($ei==6){
			for($i=$si;$i<=$ei;$i++){
				$workingdays[] = $days[$i];		
			}
		}
		else{
			$ending = $ei+1;
			for($i=$si;$i!=$ending;$i++){
				$workingdays[] = $days[$i];
				if($i==6){
					$i=0;
				}
			}
		}

		if(in_array($checkday,$workingdays)){
			return true;
		}else{
			return false;
		}
	}
}
?>
