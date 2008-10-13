<?php
/**
 * RSS_RSSHelper
 *
 * RSS functions
 *
 * @copyright 2008-08-11, SANH
 */

class
RSS_RSSHelper
{
	public static function
		get_widget_content(RSS_RSS $rss)
	{
		$div = new HTMLTags_Div();

		$div->append(self::get_rss_titles_ul($rss));

		return $div;
	}
	
	public static function
		get_widget_title(RSS_RSS $rss)
	{
		return $rss->get_feed_title();
	}

	public static function
		get_rss_titles_ul(RSS_RSS $rss)
	{
		$xmlObj = $rss->get_xml();

		$tempCounter = 0;
		$ul = new HTMLTags_UL();

		foreach ($xmlObj->entry as $item)
		{                    
			//                        print_r($item->link);exit;
			//                        
			# DISPLAY ONLY 10 ITEMS.
			if ($tempCounter < 11)
			{
				$title = (string) $item->title;
				$url_file = (string) $item->link->attributes()->href;

				$li = new HTMLTags_LI();
				$a = new HTMLTags_A();
				$url = new HTMLTags_URL();
				$url->set_file($url_file);
				$a->set_href($url);
				$a->append($title);
				$li->append($a);
				$ul->append($li);
			}

			$tempCounter += 1;
		}
		return $ul;
	}
	
}
?>
