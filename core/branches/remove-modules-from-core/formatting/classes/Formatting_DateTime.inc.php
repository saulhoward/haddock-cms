<?php
/**
 * Formatting_DateTime
 *
 * @copyright Clear line web design, 2007-03-06
 */

class Formatting_DateTime
{
    
    public static function datetime_to_ISO8601($datetime)
    {
        return strftime('%Y%m%d', strtotime($datetime));
    }
    
    public static function datetime_to_human_readable($datetime)
    {
        return strftime('%e %b, %Y', strtotime($datetime));
    }
    
  
}
?>
