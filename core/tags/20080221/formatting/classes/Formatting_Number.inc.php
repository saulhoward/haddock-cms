<?php
/**
 * Formatting_Number
 *
 * RFI & SANH 2006-12-07
 */

class Formatting_Number
{
    private $number;
    
    public function __construct($number)
    {
        if (!(is_numeric($number))) {
            throw new Exception("$number is not numeric in Formatting_CountingNumber!");
        }
        
        $this->number = $number;
    }
    
    public function get_number()
    {
        return $this->number;
    }
}
?>
