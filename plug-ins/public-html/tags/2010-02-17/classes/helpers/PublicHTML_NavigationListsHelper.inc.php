<?php
/**
 * PublicHTML_NavigationListsHelper
 *
 * @copyright 2009-02-05, Robert Impey
 */

/**
 * A collection of functions for generating and rendering navigation
 * lists.
 */
class
	PublicHTML_NavigationListsHelper
{
	/**
	 * Renders a UL with navigation links.
	 *
	 * @param array $navigation_pages The pages that we might want to visit.
	 * @param string $current_page_class The class of the current page.
	 * @param boolean $css_class The CSS class of the list.
	 */
	public static function
		render_navigation_ul(
			$navigation_pages,
			$current_page_class = NULL,
			$css_class = 'navigation'
		)
	{
		echo '<ul class="' . $css_class . '">' . PHP_EOL;
		foreach ($navigation_pages as $navigation_page) {
			echo '<li';
			
			if (isset($current_page_class)) {
				if ($current_page_class == $navigation_page['page-class']) {
					echo ' class="selected"';
				}
			}
			
			echo ">\n";
			
			echo '<a ';
			echo 'href="' . $navigation_page['href'] . '" ';
			echo 'title="' . $navigation_page['title'] . '"';
			echo '>';
			
			echo $navigation_page['text'];
			echo "</a>\n";
			
			echo "</li>\n";
		}
		echo "</ul>\n";
	}
}
?>