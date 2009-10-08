<?php
/**
 * Navigation_NodesHelper
 *
 * @copyright 2008-05-01, RFI
 */

class
	Navigation_NodesHelper
{
	public static function
		get_link_a($node)
	{
//        echo '<a ';
//		echo ' href="' . $node['url_href'] . '" ' ;
//		echo ' title="' . $node['url_title'] . '" ';
//		
//		if ($node['open_in_new_window'] == 'Yes') {
//			echo ' target="_blank" ';
//		}
//		
//		echo '>';
//		
//		echo $node['url_title'];
//		
//		echo "</a>\n";
		
		$a = new HTMLTags_A($node['url_title']);
		
		$a->set_href(
			HTMLTags_URL
				::parse_and_make_url(
					$node['url_href']
				)
		);
		
		$a->set_attribute_str(
			'title',
			$node['url_title']
		);
		
		if ($node['open_in_new_window'] == 'Yes') {
			#echo ' target="_blank" ';
			
			$a->set_attribute_str(
				'target',
				'_blank'
			);
		}
		
		return $a;
	}

	public static function
		get_link_a_with_span($node)
	{

		$span = new HTMLTags_Span();
		$span->append($node['url_title']);
		$a = new HTMLTags_A();
		$a->append($span);
		
		$a->set_href(
			HTMLTags_URL
				::parse_and_make_url(
					$node['url_href']
				)
		);
		
		$a->set_attribute_str(
			'title',
			$node['url_title']
		);
		
		if ($node['open_in_new_window'] == 'Yes') {
			#echo ' target="_blank" ';
			
			$a->set_attribute_str(
				'target',
				'_blank'
			);
		}
		
		return $a;
	}
}
?>
