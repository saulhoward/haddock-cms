<?php
class
	Formatting_NumbersHelper
{
	public static function
		pence_to_pounds($pence, $pence_in_a_pound = 100, $separator = '.', $decimal_places = 2)
	{
		$whole_pounds = floor($pence / $pence_in_a_pound);
		
		if ($whole_pounds > 0) {
			$pence_part = $pence % $whole_pounds;			
		} else {
			$pence_part = $pence;
		}
		
		$pounds = $whole_pounds . $separator . $pence_part;
		
		$pounds = sprintf('%.' . $decimal_places . 'f', $pounds);
		
		return $pounds;
	}
	
	public static function
		pounds_to_pence($pounds, $pence_in_a_pound = 100, $separator = '\.', $decimal_places = 2)
	{
		$pounds = trim($pounds);
		
		$pence = NULL;
		
		$regex = '/^([0-9]+)(?:' . $separator . '([0-9]{' . $decimal_places . '}))?$/';
		
		#echo "$regex\n";
		
		if (preg_match($regex, $pounds, $matches)) {
			#print_r($matches);
			
			$pence = $matches[2];
			
			$pence += $matches[1] * $pence_in_a_pound;
		}
		
		#echo $pence;
		
		#exit;
		
		return $pence;
	}	
}
?>