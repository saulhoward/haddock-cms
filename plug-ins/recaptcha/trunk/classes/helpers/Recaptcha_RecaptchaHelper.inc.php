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
        check_recaptcha_answer(
            $server_remote_address,
            $challenge_field,
            $response_field
        )
    {
        self::include_recaptcha_library();
        $resp = \hpi_recaptcha\recaptcha_check_answer(
            self::get_private_key_from_config(),
            $server_remote_address,
            $challenge_field,
            $response_field
        );

        if (!$resp->is_valid) {
            // What happens when the CAPTCHA was entered incorrectly
            throw new Recaptcha_Exception("The CAPTCHA was incorrect. Please try again.");
        } else {
            return TRUE;
        }
    }

    public static function
        get_private_key_from_config()
    {
        $cm = self::get_config_manager();
        return $cm->get_private_key();
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
