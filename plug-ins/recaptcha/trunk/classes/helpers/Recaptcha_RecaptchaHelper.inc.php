<?php
/**
 * Recaptcha_RecaptchaHelper
 *
 * @copyright 2010-09-01, Saul Howard
 */

class
Recaptcha_RecaptchaHelper
{
    public static function
        include_recaptcha_library()
    {
        // require_once('recaptchalib.php');
        require_once( PROJECT_ROOT . '/plug-ins/recaptcha/libraries/recaptchalib.php');
    }

    public static function
        get_recaptcha_html()
    {
        self::include_recaptcha_library();
        return \hpi_recaptcha\recaptcha_get_html(
            self::get_public_key_from_config()
        );
    }

    public static function
        get_public_key_from_config()
    {
        $cm = self::get_config_manager();
        return $cm->get_public_key();
    }

    public static function
        get_config_manager()
    {
        $cmf = HaddockProjectOrganisation_ConfigManagerFactory::get_instance();
        return $cmf->get_config_manager('plug-ins', 'recaptcha');
    }
}
?>
