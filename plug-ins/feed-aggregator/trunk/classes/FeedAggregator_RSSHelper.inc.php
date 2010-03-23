<?php
/**
 * FeedAggregator_FeedAggregatorHelper
 *
 * FeedAggregator functions
 *
 * @copyright 2008-08-11, SANH
 */

class
FeedAggregator_FeedAggregatorHelper
{
	public static function
		get_widget_content(FeedAggregator_FeedAggregator $rss)
	{
		$div = new HTMLTags_Div();
		$div->set_attribute_str('class', 'rss');

		$div->append(self::get_rss_titles_ul($rss));
		return $div;
	}
	
	public static function
		get_widget_title(FeedAggregator_FeedAggregator $rss)
	{
		return $rss->get_feed_title();
	}

	public function
		get_rss_titles_ul(FeedAggregator_FeedAggregator $rss, $limit = 10)
	{
//                print_r($rss->get_xml());exit;
		$items = $rss->get_items();

		$tempCounter = 0;
		$ul = new HTMLTags_UL();
		$ul->set_attribute_str('class', 'rss');

		foreach ($items as $item)
		{                    
			# DISPLAY ONLY 10 ITEMS.
			if ($tempCounter < ($limit + 1))
			{
				$li = new HTMLTags_LI();
				if (($tempCounter%2) == 0)
				{
					$li->set_attribute_str('class', 'odd');
				}
				$a = new HTMLTags_A();
				$url = new HTMLTags_URL();
				$url->set_file($item->get_url_filename());
				$a->set_href($url);
				$a->append($item->get_title());
				$li->append($a);
				$ul->append($li);
			}

			$tempCounter += 1;
		}
		return $ul;
	}
}
?>
