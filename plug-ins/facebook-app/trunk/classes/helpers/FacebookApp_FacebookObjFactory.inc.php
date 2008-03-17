<?php

class FacebookApp_FacebookObjFactory
{
	private static $facebook;
	private static $user;

	public static function
		get_facebook_object()
	{
		if (!isset(self::$facebook))
		{
			// the facebook client library
			include_once PROJECT_ROOT . '/project-specific/includes/client/facebook.php';
			// this defines facebook dev passwords
			include_once PROJECT_ROOT . '/project-specific/includes/config.php';

			self::$facebook = new Facebook($api_key, $secret);

			// Do the require login as well (returns user)
			if (!isset(self::$user))
			{
				self::$user = self::$facebook->require_login();
			}
		}

		return self::$facebook;
	}

	public static function
		get_user()
	{
		if (!isset(self::$user))
		{
			self::$user = self::$facebook->require_login();
		}

		return self::$user;
	}

}



?>
