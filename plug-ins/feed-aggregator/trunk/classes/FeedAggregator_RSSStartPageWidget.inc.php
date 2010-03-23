<?php
/*
 * FeedAggregator_FeedAggregatorStartPageWidget
 *
 * An abstract class for FeedAggregator Start Page Widgets
 *
 * Extend this and implement 
 * get_rss_url() and get_rss_version()
 * for your own rss widget
 *
 * 2008-10-14 SANH
 */
abstract class 
FeedAggregator_FeedAggregatorStartPageWidget
extends
Admin_StartPageWidget
{
	private $rss; // FeedAggregator_FeedAggregator Object initialised in get_rss()

	protected function
		get_widget_title()
	{
		try
		{
			$rss = $this->get_rss();
		}
		catch (Exception $e) // if $this->rss isn't an FeedAggregator_FeedAggregator object, for example
		{
			return 'FeedAggregator Feed';
		}

		return FeedAggregator_FeedAggregatorHelper::get_widget_title($rss);
	}

	protected function
		get_widget_content()
	{
		try
		{

			$rss = $this->get_rss();
		}
		catch (Exception $e) // if $this->rss isn't an FeedAggregator_FeedAggregator object, for example
		{
			return '<p class="error">FeedAggregator feed not found</p>';
		}

		return FeedAggregator_FeedAggregatorHelper::get_widget_content($rss);
	}

	protected function
		get_rss()
	{
		if (!isset($this->rss))
		{
			try
			{
				$this->rss = new FeedAggregator_FeedAggregator(
					$this->get_rss_url(),
					$this->get_rss_version()
				);
			}
			catch (Exception $e) // FeedAggregator_FeedAggregator constructor failed
			{
				$this->rss = NULL;
				throw new Exception ('FeedAggregator_FeedAggregator object creation failed');
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
