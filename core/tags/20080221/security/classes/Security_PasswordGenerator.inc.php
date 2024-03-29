<?php
/**
 * Security_PasswordGenerator
 *
 * @copyright Clear Line Web Design, 2006-11-21
 */

/**
 * Returns passwords that are pseudo-random.
 *
 * Uses the singleton pattern.
 */
class
    Security_PasswordGenerator
{
    static private $instance = NULL;
    
    private function
        __construct()
    {
    }
    
    public static function
        get_instance()
    {
        if (self::$instance == NULL) {
            self::$instance = new Security_PasswordGenerator();
        }
        
        return self::$instance;
    }
    
    public function get_password($length = 8)
    {
        if ($length < 1) {
            $msg = 'Passwords must have at least one chararcter!'
                . " \$length: $length!";
            throw new Exception($msg);
        }
        
        $password = '';
        
        $characters = '';
        
        //for ($i = ord('A'); $i <= ord('Z'); $i++) {
        //    $characters .= chr($i);
        //}
        
        $characters .= 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        
        //for ($i = ord('a'); $i <= ord('z'); $i++) {
        //    $characters .= chr($i);
        //}
        
        $characters .= 'abcdefghijkmnpqrstuvwxyz';        
        
        for ($i = 0; $i <= 9; $i++) {
            $characters .= $i;
        }
        
        #$characters .= '!?*&%$£{}[]+-~@:;.,';
        
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $position = mt_rand(0, $max);
            $password .= $characters[$position];
        }
        
        return $password;
    }
}
?>
