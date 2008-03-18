<?php
/**
 * Formatting_ListOfWordsHelper
 *
 * @copyright 2008-03-17, RFI
 */

/**
 * Convenience functions for using the list of words class.
 */
class
	Formatting_ListOfWordsHelper
{
	public static function
		capitalise_delimited_string(
			$str,
			$delim = NULL
		)
	{
		$low = self::get_list_of_words_for_string($str, $delim);
		
		return $low->get_words_as_capitalised_string();
	}

	public static function
		get_list_of_words_for_string(
			$str,
			$separator = NULL
		)
	{
		if (!isset($separator)) {
			$separator = ' ';
		}
		
		$words_in_str = explode($separator, $str);
		
		$words = array();
		
		foreach ($words_in_str as $w_i_s) {
			$words[] = new Formatting_Word($w_i_s);
		}
		
		$list_of_words = new Formatting_ListOfWords($words);
		
		return $list_of_words;
	}
}
?>