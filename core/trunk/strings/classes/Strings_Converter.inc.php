<?php
/**
 * Strings_Converter
 *
 * @copyright Clear Line Web Design, 2007-05-07
 */

class
    Strings_Converter
{
    /**
     * Converts a string with any sort of line endings
     * to UNIX line endings.
     */
    public static function
        line_endings_to_unix($str)
    {
        return preg_replace("/\r\n/", "\n", $str);
    }
}
?>
