<?php
/**
 * FeedAggregator_DownloadException
 *
 * @copyright 2009-10-02, SANH
 */

class
FeedAggregator_DownloadException
extends
FeedAggregator_Exception
{
	public function
		__construct($msg)
	{
		parent::__construct("Download Error: " . $msg);
	}

}
?>
