<?php
/**
 * LeftNavigationDiv_LayoutLTEIE7CascadingStyleSheet
 *
 * @copyright 2010-02-08, Robert Impey
 */

class
	LeftNavigationDiv_LayoutLTEIE7CascadingStyleSheet
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
 * Little Hack for IE browsers less than or equal to IE7
 *
 * (c) copyright 2010-02-08, Robert Impey
 */

div#directory_contents {
	display: inline-block;
}


CSS;

	}
}
?>
