<?php
/**
 * VideoLibrary_ExternalLibraryHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_ExternalLibraryHelper
{
	public static function
		get_default_external_library_id()
	{
                /******
		 *       TODO
		 *        Put this value into a project-specific config file.
		 *        Probably go for the full XML so there's only one, 
		 *        or we're gonna have a bunch of text files.
                 */
		return 1;
	}

	public static function
		get_current_external_video_library_id()
	{
		if (isset($_GET['external_video_library_id'])) {
			return $_GET['external_video_library_id'];
		}
		else {
			return self::get_default_external_library_id();
		}
	}
}
?>
