<?php
/**
 * CodeAnalysis_DebugModeHelper
 *
 * @copyright 2009-10-07, Robert Impey
 */

/**
 * Functions to do with debug mode.
 *
 * When a project is in debug mode, a lot of debug information gets
 * printed.
 *
 * If you are using the public-html plug-in, the output will be as text
 * rather than HTML.
 */
class
	CodeAnalysis_DebugModeHelper
{
	private static function
		get_debug_mode_file_name()
	{
		return PROJECT_ROOT . '/DEBUG.inc.php';
	}
	
	public static function
		turn_on_debug_mode()
	{
		$debug_mode_file_name = self::get_debug_mode_file_name();
		
		if ($fh = fopen($debug_mode_file_name, 'w')) {
			fwrite($fh, '<?php define(\'DEBUG\', TRUE); ?>' . PHP_EOL);
			
			fclose($fh);
		}
	}
	
	public static function
		turn_off_debug_mode()
	{
		$debug_mode_file_name = self::get_debug_mode_file_name();
		
		if (file_exists($debug_mode_file_name)) {
			unlink($debug_mode_file_name);
		}
	}
}
?>