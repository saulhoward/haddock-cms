<?php
/**
 * DBPages_Section
 *
 * @copyright RFI 2007-12-15
 */

class
	DBPages_Section
{
	private $text;
	private $filter_function_name;
	
	public function
		__construct(
			$text,
			$filter_function_name = NULL
		)
	{
		$this->text = $text;
		$this->filter_function_name = $filter_function_name;
	}
	
	/**
	 * Returns the text of this section.
	 *
	 * If a filter function has been set, then the text will be
	 * passed through it before being returned.
	 */
	public function
		get_filtered_text()
	{
		#echo __FUNCTION__;
		#exit;
		
		$ttr = $this->text; /* Text to return */
		#echo $ttr;
		#exit;
		
		if (isset($this->filter_function_name)) {
			$ffn = $this->filter_function_name;
			
			if (preg_match('/(\w+)::(\w+)/', $ffn, $matches)) {
				array_shift($matches);
				$cb = $matches;
			} else {
				$cb = $ffn;
			}
			
			#print_r($cb);
			#exit;
			
			$ttr = call_user_func($cb, $ttr);
		}
		
		#echo $ttr;
		#exit;
		
		return $ttr;
	}
}
?>