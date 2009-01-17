<?php
/**
 * CLIScripts_DataRenderingHelper
 *
 * @copyright 2008-05-27, Robert Impey
 */

/**
 * A collection of functions for rendering data in
 * a CLI script.
 */
class
	CLIScripts_DataRenderingHelper
{
	/**
	 * Renders an array of assocs in a table.
	 *
	 * @param array $array_of_assocs The array of assocs to render.
	 * @param array $title_overrides Optional assoc of titles to override the default capitalisation.
	 */
	public static function
		render_array_of_assocs_in_table(
			$array_of_assocs,
			$title_overrides = NULL
		)
	{
		if (count($array_of_assocs) > 0) {
			/*
			 * Make the titles.
			 */
			$titles = array();
			
			foreach (
				array_keys($array_of_assocs[0])
				as
				$key
			) {
				$titles[$key]
					= Formatting_ListOfWordsHelper
						::capitalise_delimited_string(
							$key,
							'_'
						);
			}
			
			/*
			 * Has the user overridden one of the titles?
			 */
			if (isset($title_overrides)) {
				foreach (
					array_keys($title_overrides)
					as
					$key
				) {
					$titles[$key] = $title_overrides[$key];
				}
			}
			
			/*
			 * Make the columns the correct width.
			 */
			$column_widths = array();
			foreach (
				array_keys($titles)
				as
				$key
			) {
				$column_widths[$key] = strlen($titles[$key]);
				
				foreach (
					$array_of_assocs
					as
					$assoc
				) {
					$field_width = strlen($assoc[$key]);
					$column_widths[$key]
						= ($column_widths[$key] > $field_width)
							? $column_widths[$key] : $field_width;
				}
			}
			
			/*
			 * Put the titles together.
			 */
			$title_str = '|';
			foreach (
				array_keys($titles)
				as
				$key
			) {
				$title_str
					.= str_pad(
						$titles[$key],
						$column_widths[$key],
						' ',
						STR_PAD_BOTH
					);
					
				$title_str
					.= '|';
			}
			
			/*
			 * Make a horizontal rule to separate the titles from the data.
			 */
			$hr
				= str_repeat(
					'-',
					strlen($title_str) - 2
				);
			
			$title_str = $title_str . PHP_EOL;
			#$hr = "|$hr|" . PHP_EOL;
			$hr = "+$hr+" . PHP_EOL;
			
			echo $hr;
			echo $title_str;
			echo $hr;
			
			/*
			 * Render the data.
			 */
			foreach (
				$array_of_assocs
				as
				$assoc
			) {
				echo '|';
				
				foreach (
					array_keys($assoc)
					as
					$key
				) {
					echo
						str_pad(
							$assoc[$key],
							$column_widths[$key],
							' ',
							STR_PAD_BOTH
						);
					
					echo '|';
				}
				
				echo PHP_EOL;
			}
			
			echo $hr;
		}
	}
}
?>