<?php
/**
 * FeedAggregator_DatabaseHelper
 *
 * @copyright 2010-03-19, SANH
 */

class
FeedAggregator_DatabaseHelper
{
	public function
        add_feed(
            $name,
            $title,
            $description,
            $url,
            $format
        )
    {
        $dbh = DB::m();
        $name = FeedAggregator_FeedHelper->correct_feed_name($name);
        $name = mysql_real_escape_string($name);
        $title = mysql_real_escape_string($title);
        $description = mysql_real_escape_string($description);
        $url = mysql_real_escape_string($url);
        $format = mysql_real_escape_string(trim($format));

        $stmt = <<<SQL
INSERT
INTO
    hpi_feed_aggregator_feeds
SET
    name = '$name',
    title = '$title',
    description = '$description',
    url = '$url',
    format = '$format'

SQL;

        //print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);

        $id =  mysql_insert_id($dbh);
        $this->add_feed_to_retrieval_queue($id);
        return $id;
    }

	public function
        add_feed_to_retrieval_queue(
            $id
        )
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id);
        $frequency_minutes = mysql_real_escape_string(
            FeedAggregator_ConfigManager::
            get_default_feed_retrieval_frequency_in_minutes()
        );

        $stmt = <<<SQL
INSERT
INTO
    hpi_feed_aggregator_feed_retrieval_queue
SET
    feed_id = '$id',
    frequency_minutes = '$frequency_minutes',
    last_retrieved = NULL,
    status = `skip`

SQL;

        //print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);

        $id =  mysql_insert_id($dbh);
        return $id;
    }

	public function
        edit_feed(
            $id,
            $name,
            $title,
            $description,
            $url,
            $format
        )
     {
		//print_r($_POST);exit;
		//print_r($_GET);exit;
        $id = mysql_real_escape_string($id, $dbh);
        $name = FeedAggregator_FeedHelper::correct_feed_name($name);
        $name = mysql_real_escape_string($name, $dbh);
        $title = mysql_real_escape_string($title, $dbh);
        $description = mysql_real_escape_string($description, $dbh);
        $url = mysql_real_escape_string($url, $dbh);
        $format = mysql_real_escape_string(trim($format), $dbh);

		$stmt = <<<SQL
UPDATE
    hpi_feed_aggregator_feeds
SET
    name = '$name',
    title = '$title',
    description = '$description',
    url = '$url',
    format = '$format'
WHERE
	id = $id
SQL;

		//print_r($stmt);exit;
		$result = mysql_query($stmt, $dbh);
		return $id;
	}

	public function
        delete_feed(
            $id
        )
	{
		$dbh = DB::m();
		$id = mysql_real_escape_string($id, $dbh);
		
		$stmt = <<<SQL
DELETE
FROM
	hpi_feed_aggregator_feeds
WHERE
	id = $id
SQL;
		
		#echo $stmt; exit;
		mysql_query($stmt, $dbh);
        return $id;
	}
	
	public function
		delete_all_feeds()
	{
		$dbh = DB::m();
		
		$stmt = <<<SQL
TRUNCATE TABLE
	hpi_feed_aggregator_feeds
SQL;

		mysql_query($stmt, $dbh);
	}
	

}
?>
