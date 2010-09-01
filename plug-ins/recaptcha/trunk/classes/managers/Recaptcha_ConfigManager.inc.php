<?php
/**
 * Recaptcha_ConfigManager
 *
 * @copyright 2010-03-19, SANH
 */

class
Recaptcha_ConfigManager
extends
HaddockProjectOrganisation_ConfigManager
{
    protected function
        get_module_prefix_string()
    {
        return '/plug-ins/recaptcha/';
    }

    public function
        get_public_key()
    {
        return trim(
            $this->get_config_value('keys/public')
        );
    }

    public function
        get_private_key()
    {
        return trim(
            $this->get_config_value('keys/private')
        );
    }

}
?>
