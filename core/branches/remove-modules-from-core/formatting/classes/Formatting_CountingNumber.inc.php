<?php
/**
 * Formatting_CountingNumber
 *
 * RFI & SANH 2006-12-07
 */

require_once PROJECT_ROOT . '/haddock/formatting/classes/Formatting_Number.inc.php';

/**
 * For displaying the counting numbers:
 *
 * 1, 2, 3, ...
 */
class Formatting_CountingNumber extends Formatting_Number
{
    public function __construct($number)
    {
        #if (!is_int($number)) {
        #    throw new Exception("$number is not an integer in Formatting_CountingNumber!");
        #}
        
        if ($number < 1) {
            throw new Exception("$number is less than 1 in Formatting_CountingNumber!");
        }
        
        parent::__construct(floor($number));
    }
    
    /**
     * Returns the cardinal of the number, taking
     * in to account:
     *
     * 1st, 2nd, 3rd, 4th ...
     * 11th, 12th, 13th, ...
     * 21st, 22nd, 23rd, ...
     */
    public function get_cardinal()
    {
        $number = $this->get_number();
        
        $cardinal = $number;
        
        if (preg_match('/(?<!1)([123])$/', $number, $matches)) {
            switch ($matches[1]) {
                case 1 :
                    $cardinal .= 'st';
                    break;
                case 2 :
                    $cardinal .= 'nd';
                    break;
                case 3 :
                    $cardinal .= 'rd';
            }
        } else {
            $cardinal .= 'th';
        }
        
        return $cardinal;
    }
    
    public static function get_cardinal_range($from, $to)
    {
        $range = '&#40;';
        
        $from_c_n = new Formatting_CountingNumber($from);
        $range .= $from_c_n->get_cardinal();
        
        $range .= ' &#45;&#62; ';
        
        $to_c_n = new Formatting_CountingNumber($to);
        $range .= $to_c_n->get_cardinal();
        
        $range .= '&#41;';
        
        return $range;  
    }
}
?>
