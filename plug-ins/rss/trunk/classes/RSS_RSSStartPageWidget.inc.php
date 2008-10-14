<?php
/*
 * RSS_RSSStartPageWidget
 *
 * An abstract class for RSS Start Page Widgets
 *
 * Extend this and implement 
 * get_rss_url() and get_rss_version()
 * for your own rss widget
 *
 * 2008-10-14 SANH
 */
abstract class 
	RSS_RSSStartPageWidget
extends
	Admin_StartPageWidget
{
	private $rss; // RSS_RSS Object initialised in get_rss()
	private $rss_constructor_succeeded = TRUE; // In case $rss throws an exception

	protected function
		get_widget_title()
	{
		if ($this->rss_constructor_succeeded)
		{
			return RSS_RSSHelper::get_widget_title($this->get_rss());
		}
		else
		{
			return 'RSS Feed';
		}
	}

	protected function
		get_widget_content()
	{
		if ($this->rss_constructor_succeeded)
		{
			return RSS_RSSHelper::get_widget_content($this->get_rss());
		}
		else
		{
			return '<p class="error">RSS feed not found</p>';
		}
	}

	protected function
		get_rss()
	{
		if (!isset($this->rss))
		{
			try
			{
				$this->rss = new RSS_RSS(
					$this->get_rss_url(),
					$this->get_rss_version()
				);
			}
			catch (Exception $e)
			{
				$this->rss_constructor_succeeded = FALSE;
			}
		}

		return $this->rss;
	}

	abstract protected function
		get_rss_url();

	abstract protected function
		get_rss_version();
}
?>
