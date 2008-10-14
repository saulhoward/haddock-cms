<?php

class 
	RSS_BBCSportRSSStartPageWidget
extends
	RSS_RSSStartPageWidget
{
	protected function
		get_rss_url()
	{
		return <<<URL
http://newsrss.bbc.co.uk/rss/sportonline_uk_edition/front_page/rss.xml
URL;

	}

	protected function
		get_rss_version()
	{
		return 'rss2';
	}

	protected function
		get_widget_title()
	{
		return "BBC Sport";
	}
}
?>
