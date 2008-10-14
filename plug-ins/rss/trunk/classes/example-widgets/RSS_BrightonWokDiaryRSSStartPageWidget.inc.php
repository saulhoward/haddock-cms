<?php

class 
	RSS_BrightonWokDiaryRSSStartPageWidget
extends
	RSS_RSSStartPageWidget
{
	protected function
		get_rss_url()
	{
		return <<<URL
http://www.brighton-wok.com/diary/?feed=atom
URL;

	}

	protected function
		get_rss_version()
	{
		return 'atom';
	}

//        protected function
//                get_widget_title()
//        {
//                return "Brighton Wok Production Diary";
//        }
}
?>
