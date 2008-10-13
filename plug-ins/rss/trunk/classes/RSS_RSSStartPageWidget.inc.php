<?php

abstract class 
	RSS_RSSStartPageWidget
extends
	Admin_StartPageWidget
{
	private $rss;

	protected function
		get_widget_title()
	{
		return RSS_RSSHelper::get_widget_title($this->get_rss());
//                return $this->get_rss()->get_feed_title();
	}

	protected function
		get_widget_content()
	{
		return RSS_RSSHelper::get_widget_content($this->get_rss());
	}

	protected function
		get_rss()
	{
		if (!isset($this->rss))
		{
			$this->rss = new RSS_RSS($this->get_rss_url());
		}
		return $this->rss;
	}

	abstract protected function
		get_rss_url();
}
?>
