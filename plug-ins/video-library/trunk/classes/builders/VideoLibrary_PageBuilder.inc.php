<?php
/**
 * VideoLibrary_PageBuilder
 *
 * @copyright 2008-02-09, RFI
 */

class
	VideoLibrary_PageBuilder
{
	public function
		get_first_tier_navigation_div()
	{
		$div = new HTMLTags_Div();
		$div->append(
			'<ul><li><a href="/">Home</a></li></ul>'
		);
		return $div;
	}
}
?>
