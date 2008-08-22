<?php
/**
 * Send the headers for an image from the DB.
 *
 * @copyright Clear Line Web Design, 2007-04-04
 */

/*
 * How do we get the browser (or proxy) to cache
 * our images?
 *
 * On the whole, the images are not going to change much
 * after they have been added to the database and so
 * we want to have as much caching as possible.
 */
#header('Pragma: cache');

/*
 * Tell the client the type of image being served.
 */
header("Content-type: " . $image->get_file_type());
?>
