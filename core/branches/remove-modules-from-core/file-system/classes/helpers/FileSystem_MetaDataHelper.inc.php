<?php
/**
 * FileSystem_MetaDataHelper
 *
 * @copyright 2010-01-26, Robert Impey
 */

/**
 * A collection of functions for helping with the meta data
 * (file size, names etc.) of files.
 */
class
	FileSystem_MetaDataHelper
{
	/**
	 * Taken from http://refactormycode.com/codes/67-bytes-to-readable
	 * Copyright retained by original authors.
	 */
	public static function
		bytes_to_readable($size)
	{
		$si = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		
		$remainder = $i = 0;
		
		while ($size >= 1024 && $i < 8) {
			$remainder = (($size & 0x3ff) + $remainder) / 1024;
			$size = $size >> 10;
			$i++;
		}
		
		return round($size + $remainder, 2) . ' ' . $si[$i];
	}
}
?>