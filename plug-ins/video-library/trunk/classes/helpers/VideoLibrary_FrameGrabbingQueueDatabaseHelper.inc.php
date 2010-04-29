<?php
/**
 * VideoLibrary_FrameGrabbingQueueDatabaseHelper
 *
 * @copyright 2009-01-10, SANH
 *
 * Contains all MySQL DB functions for the Frame Grabbing functionality 
 * of the VideoLibrary plugin
 */

class
VideoLibrary_FrameGrabbingQueueDatabaseHelper
{
    public function
        video_exists_in_external_videos_frame_grabbing_queue_by_external_video_id($id)
    {
        $dbh = DB::m();
        $id = mysql_real_escape_string($id);

        $stmt = <<<SQL
SELECT
    COUNT(*) as count
FROM
    hpi_video_library_external_videos_frame_grabbing_queue
WHERE
    external_video_id = $id

SQL;

        // print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);
        $row = mysql_fetch_assoc($result);
        // print_r($row);exit;

        if ( $row['count'] > 0 ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function
		add_video_to_external_videos_frame_grabbing_queue($id)
	{
		$dbh = DB::m();
		$id = mysql_real_escape_string($id);

		$stmt = <<<SQL
INSERT
INTO
	hpi_video_library_external_videos_frame_grabbing_queue
SET
	external_video_id = $id

SQL;

        // print_r($stmt);exit;

		$result = mysql_query($stmt, $dbh);

		return $id;
	}

    public static function
        get_external_videos_frame_grabbing_queue(
            $where_clause
        )
    {
        $dbh = DB::m();

        $query = '';
        $query .= <<<SQL
SELECT *
FROM
        hpi_video_library_external_videos_frame_grabbing_queue
WHERE
        $where_clause
SQL;

        //print_r($query); exit;

        $result = mysql_query($query, $dbh);
        $videos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $videos[] = $row;
        } 
        return $videos;
    }

    public static function
        update_external_video_frame_grabbing_queue_for_video(
            $queue_id
        )
    {
        $dbh = DB::m();
        $queue_id = mysql_real_escape_string($queue_id);

        $stmt = <<<SQL
UPDATE
    hpi_video_library_external_videos_frame_grabbing_queue
SET
    last_processed = NOW()
WHERE
    id = $queue_id

SQL;

        //print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);
        return $queue_id;
    }

    public function
        reset_external_videos_frame_grabbing_queue()
    {
        //print_r($_POST);exit;
        //print_r($_GET);exit;

        $dbh = DB::m();
        $stmt = <<<SQL
UPDATE
    hpi_video_library_external_videos_frame_grabbing_queue
SET
    last_processed = NULL
SQL;

        //print_r($stmt);exit;

        $result = mysql_query($stmt, $dbh);

        //return $id;
    }

    public function
		requeue_video_in_external_videos_frame_grabbing_queue_by_external_video_id($id)
	{
        if (self::video_exists_in_external_videos_frame_grabbing_queue_by_external_video_id($id)) {
            $dbh = DB::m();
            $id = mysql_real_escape_string($id);

            $stmt = <<<SQL
UPDATE
    hpi_video_library_external_videos_frame_grabbing_queue
SET
    last_processed = NULL
WHERE
    external_video_id = $id

SQL;

            //print_r($stmt);exit;

            $result = mysql_query($stmt, $dbh);

            return $id;
        } else {
            return self::
                add_video_to_external_videos_frame_grabbing_queue($id);
        }
	}
}
?>
