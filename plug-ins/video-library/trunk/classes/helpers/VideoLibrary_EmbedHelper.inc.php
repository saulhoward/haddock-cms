<?php
/**
 * VideoLibrary_EmbedHelper
 *
 * @copyright 2009-01-10, SANH
 */

class
VideoLibrary_EmbedHelper
{
	public static function
		get_video_embed_code_for_external_video(
			$video_data
		)
	{
		/**
		 * Creates an instance of the provider class named in the video data,
		 * Gets the embed code and inserts the correct providers id
		 */
		$provider_class_str = trim($video_data['haddock_class_name']);
		$instance = new $provider_class_str();
		//$instance->set_providers_internal_id($video_data['providers_internal_id']);
		return str_replace(
			'%video_id',
			$video_data['providers_internal_id'],
			$instance->get_video_embed_code()
		);
	}
}
?>
