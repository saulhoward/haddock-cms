<?php
/**
 * Security_PasswordsHelper
 *
 * @copyright 2008-12-23, Robert Impey
 */

class
	Security_PasswordsHelper
{
    /**
     * Makes a new password.
     * 
     * @param int $length The desired length of the password.
     * @param string $characters The characters that are allowed in the new password.
     * @return string The new password.
     */
	public static function
        make_password(
            $length = 8,
            $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789'
        )
    {
        $password = '';

        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $position = mt_rand(0, $max);
            $password .= $characters[$position];
        }

        return $password;
    }
}
?>