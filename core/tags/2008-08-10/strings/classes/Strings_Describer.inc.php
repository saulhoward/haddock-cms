<?php
/**
 * Strings_Describer
 *
 * @copyright Clear Line Web Design, 2007-05-07
 */

class
    Strings_Describer
{
    public static function
        just_white_space($str)
    {
        return preg_match('/^\s*$/', $str);
    }
}
?>
