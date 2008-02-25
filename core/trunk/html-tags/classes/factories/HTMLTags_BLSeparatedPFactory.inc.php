<?php
/**
 * HTMLTags_BLSeparatedPFactory
 *
 * @copyright Clear Line Web Design, 2007-05-07
 */

#require_once PROJECT_ROOT
#    . '/haddock/html-tags/classes/standard/'
#    . 'HTMLTags_P.inc.php';
#
#require_once PROJECT_ROOT
#    . '/haddock/strings/classes/'
#    . 'Strings_Splitter.inc.php';

class
    HTMLTags_BLSeparatedPFactory
{
    public function
        __construct()
    {
    }
    
    public static function
        get_ps_from_str($str)
    {
        $ps = array();
        
        $strs = Strings_Splitter::blank_line_separated($str);
        
        #print_r($strs); exit;
        
        foreach ($strs as $p_str) {
            $ps[] = new HTMLTags_P($p_str);
        }
        
        return $ps;
    }
}
?>