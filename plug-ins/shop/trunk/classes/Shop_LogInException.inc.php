<?php
/**
 * Shop_LogInException
 *
 * @copyright Clear Line Web Design, 2007-03-07
 */

class
    Shop_LogInException
extends
    Exception
{
    private $username;
    
    public function
        __construct($username)
    {
        parent::__construct("Unable to log in as $username!");
        
        $this->username = $username;
    }
}
?>
