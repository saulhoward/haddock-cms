<?php
/**
 * VideoLibrary_TagsHelper
 *
 * @copyright 2009-01-10, SANH

 * Tags, as they are defined here:
 * 
 * 1) a-z and spaces
 * 2) no beginning and end spaces
 * 
 */

class
VideoLibrary_TagsHelper
{
	public static function
		get_tags_array_for_admin_post_input(
			$post_str
		)
	{
                /*
		 *Get rid of anything that's not A-Z, a-z, commas and spaces
                 */
		$post_str = preg_replace('([^a-zA-Z,\s])', '', $post_str);

		/*
		 *Make more than one space into one space
		 */
		$post_str = preg_replace('/\s\s+/', ' ', $post_str);

		/*
		 *Make more than one comma into one comma
		 */
		$post_str = preg_replace('/,,+/', ',', $post_str);

		/*
		 *Make ', ,' into ',' (removing empty tags)
		 */
		$post_str = preg_replace('/, ,/', ',', $post_str);

		/*
		 *Remove any final commas
		 */
		$post_str = preg_replace('/,$/', '', $post_str);


		$post_str = strtolower($post_str);
		$tags = explode(',', $post_str);
		$tags = array_map('trim', $tags);

		return $tags;
	}
}
?>
