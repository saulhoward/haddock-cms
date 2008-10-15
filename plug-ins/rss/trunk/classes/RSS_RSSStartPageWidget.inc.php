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

	protected function
		get_widget_title()
	{
		try
		{
			$rss = $this->get_rss();
		}
		catch (Exception $e) // if $this->rss isn't an RSS_RSS object, for example
		{
			return 'RSS Feed';
		}

		return RSS_RSSHelper::get_widget_title($rss);
	}

	protected function
		get_widget_content()
	{
		try
		{

			$rss = $this->get_rss();
		}
		catch (Exception $e) // if $this->rss isn't an RSS_RSS object, for example
		{
			return '<p class="error">RSS feed not found</p>';
		}

		return RSS_RSSHelper::get_widget_content($rss);
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
			catch (Exception $e) // RSS_RSS constructor failed
			{
				$this->rss = NULL;
				throw new Exception ('RSS_RSS object creation failed');
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
