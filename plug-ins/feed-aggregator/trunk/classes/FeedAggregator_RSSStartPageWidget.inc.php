<?php
/*
 * FeedAggegator_FeedAggegatorStartPageWidget
 *
 * An abstract class for FeedAggegator Start Page Widgets
 *
 * Extend this and implement 
 * get_rss_url() and get_rss_version()
 * for your own rss widget
 *
 * 2008-10-14 SANH
 */
abstract class 
FeedAggegator_FeedAggegatorStartPageWidget
extends
Admin_StartPageWidget
{
	private $rss; // FeedAggegator_FeedAggegator Object initialised in get_rss()

	protected function
		get_widget_title()
	{
		try
		{
			$rss = $this->get_rss();
		}
		catch (Exception $e) // if $this->rss isn't an FeedAggegator_FeedAggegator object, for example
		{
			return 'FeedAggegator Feed';
		}

		return FeedAggegator_FeedAggegatorHelper::get_widget_title($rss);
	}

	protected function
		get_widget_content()
	{
		try
		{

			$rss = $this->get_rss();
		}
		catch (Exception $e) // if $this->rss isn't an FeedAggegator_FeedAggegator object, for example
		{
			return '<p class="error">FeedAggegator feed not found</p>';
		}

		return FeedAggegator_FeedAggegatorHelper::get_widget_content($rss);
	}

	protected function
		get_rss()
	{
		if (!isset($this->rss))
		{
			try
			{
				$this->rss = new FeedAggegator_FeedAggegator(
					$this->get_rss_url(),
					$this->get_rss_version()
				);
			}
			catch (Exception $e) // FeedAggegator_FeedAggegator constructor failed
			{
				$this->rss = NULL;
				throw new Exception ('FeedAggegator_FeedAggegator object creation failed');
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
