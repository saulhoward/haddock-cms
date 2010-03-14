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


        $embed_code = $instance->get_video_embed_code();
        $video_dimensions = self::get_video_dimensions($instance->get_video_dimensions_ratio());
		$embed_code = str_replace(
			'%video_id',
			$video_data['providers_internal_id'],
            $embed_code
		);
        $embed_code = str_replace(
			'%video_width',
			$video_dimensions[0],
            $embed_code
		);
        $embed_code = str_replace(
			'%video_height',
			$video_dimensions[1],
            $embed_code
		);
        return $embed_code;
	}

    public static function
        get_video_dimensions(
            $ratio
        )
    {
        $multiplier = 500;
        return array(
            round($multiplier * $ratio[0]),
            round($multiplier * $ratio[1])
        );
    }
}
?>
