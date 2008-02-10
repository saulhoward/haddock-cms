<?php
/**
 * InputValidation_EmailAddressValidator
 *
 * @copyright Clear Line Web Design, 2007-09-10
 */

/**
 * Should there be an abstract validator class that
 * this and other validators extend?
 *
 * References:
 *
 *  http://www.regular-expressions.info/email.html
 *  http://tools.ietf.org/html/rfc2822#section-3.4.1
 */
class
    InputValidation_EmailAddressValidator
extends
    InputValidation_Validator
{
    public function
        validate($string)
    {
        return $this->validate_email_address($string);
    }
    
    /**
     * The default validation method.
     *
     * This should always be an alias for another function.
     */
    public function
        validate_email_address($email_address)
    {
        #return $this->validate_ea_simple($email_address);
        return $this->validate_ea_tld($email_address);
        #return $this->validate_ea_rfc2822($email_address);
    }
    
    /*
     * ----------------------------------------
     * Various public methods.
     * ----------------------------------------
     */
    
    public function
        validate_ea_simple($email_address)
    {
        return
            $this->validate_ea_length($email_address)
            &&
            $this->validate_ea_simple_pattern($email_address);
    }
    
    public function
        validate_ea_tld($email_address)
    {
        return
            $this->validate_ea_length($email_address)
            &&
            $this->validate_ea_tld_pattern($email_address);
    }
    
    public function
        validate_ea_rfc2822($email_address)
    {
        return
            $this->validate_ea_length($email_address)
            &&
            $this->validate_ea_rfc2822_pattern($email_address);
    }
    
    /*
     * ----------------------------------------
     * Private helper methods.
     * ----------------------------------------
     */
    
    /**
     * The shortest email address could be something like:
     *
     * 'a@a.aa'
     *
     * which is 6 chars long.
     */
    private function
        validate_ea_length($email_address)
    {
        if (strlen($email_address) < 6) {
            throw
                new InputValidation_InvalidInputException(
                    "'$email_address' is too short to be an email address!"
                );
        }
        
        return TRUE;
    }
    
    private function
        validate_ea_pattern(
            $email_address,
            $regex,
            $exception_message = '\'%s\' is not a valid email address!'
        )
    {
        return parent
            ::validate_pattern(
                $email_address,
                $regex,
                $exception_message
            );
    }
    
    private function
        validate_ea_simple_pattern($email_address)
    {
        return $this->validate_ea_pattern($email_address, '/^[a-z0-9._%+-]+@(?:[a-z0-9-]+\.)+[a-z]{2,6}$/i');
    }
    
    private function
        validate_ea_tld_pattern($email_address)
    {
        return $this->validate_ea_pattern($email_address, '/^[a-z0-9._%+-]+@(?:[a-z0-9-]+\.)+(?:[a-z]{2}|com|org|net|gov|biz|info|name|aero|biz|info|jobs|museum)$/i');
    }
    
    private function
        validate_ea_rfc2822_pattern($email_address)
    {
        return $this->validate_ea_pattern($email_address, '/(?:[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/i');
    }
}
?>
