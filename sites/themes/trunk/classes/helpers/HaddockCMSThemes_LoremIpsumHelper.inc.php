<?php
/**
 * HaddockCMSThemes_LoremIpsumHelper
 *
 * @copyright 2009-02-02, Robert Impey
 */

/**
 * To help with rendering various meaningless place-holder texts.
 *
 * Thanks to:
 *
 * 	- http://www.lipsum.com/
 */
class
	HaddockCMSThemes_LoremIpsumHelper
{
	/**
	 * The standard content for all the different themes.
	 */
	public static function
		render_lorem_ipsum_content()
	{
?>
<h2>Lorem Ipsum</h2>
<?php
		self::render_lorem_ipsum_ps(5);
	}
	
	/**
	 * Renders the desired number of paragraphs of lorem ipsum.
	 *
	 * @param int $number_of_paragraphs The number of paragraphs of "lorem ipsum" to render.
	 */
	public static function
		render_lorem_ipsum_ps($number_of_paragraphs = 1)
	{
		for ($i = 0; $i < $number_of_paragraphs; $i++) {
?>
<p>
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
	incididunt ut labore et dolore magna aliqua.
	Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
	aliquip ex ea commodo consequat.
	Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
	eu fugiat nulla pariatur.
	Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
	deserunt mollit anim id est laborum.
</p>
<?php
		}
	}
}
?>