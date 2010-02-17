<?php
/**
 * Set the MIME type to application/xhtml+xml
 *
 * See: http://www.hixie.ch/advocacy/xhtml
 *
 * If this is too strict for you, you can add a file called.
 *
 * <DOC_ROOT>/project-specific/public-includes/page-elements/html/http-headers.inc.php
 *
 * which is similar to this, except the content type might be text/html.
 *
 * An empty file with the same name would achieve the same effect.
 *
 * @copyright Clear Line Web Design, 2007-07-20
 */

#header('Content-Type: application/xhtml+xml');
?>
