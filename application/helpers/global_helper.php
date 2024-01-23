<?php

if (!function_exists('setDayNameID')) {
	function setDayNameID($dayName)
	{
		switch ($dayName) {
			case 'Sunday':
				return 'Minggu';
				break;
			case 'Monday':
				return 'Senin';
				break;
			case 'Tuesday':
				return 'Selasa';
				break;
			case 'Wednesday':
				return 'Rabu';
				break;
			case 'Thursday':
				return 'Kamis';
				break;
			case 'Friday':
				return 'Jumat';
				break;
			case 'Saturday':
				return 'Sabtu';
				break;
		}
	}
}

if (!function_exists('setDateToID')) {
	function setDateToID($dateISOString)
	{
		$baseDate = date('d-m-Y', strtotime($dateISOString));
		$getDayNameID = setDayNameID(date('l', strtotime($dateISOString)));

		return "$getDayNameID, $baseDate";
	}
}
