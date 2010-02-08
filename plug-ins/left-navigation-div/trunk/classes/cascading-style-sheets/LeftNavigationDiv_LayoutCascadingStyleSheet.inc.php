<?php
/**
 * LeftNavigationDiv_LayoutCascadingStyleSheet
 *
 * @copyright 2010-02-08, Robert Impey
 */

class
	LeftNavigationDiv_LayoutCascadingStyleSheet
extends
	PublicHTML_CascadingStyleSheet
{
	public function
		render()
	{
		echo <<<CSS
/**
 * CSS rules for the layout of the left navigation div.
 *
 * (c) copyright 2010-02-08, Robert Impey
 */

div#directory_navigation {
	display: inline-block;
	float: left;
	
	width: 200px;
}

div#directory_contents {
	margin-left: 206px;
}


CSS;

	}
}
?>
