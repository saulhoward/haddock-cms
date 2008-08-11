<?php
/**
 * The header panel of the Admin Section of
 * a Haddock Project.
 *
 * @copyright Clear Line Web Design, 2006-11-20
 */

require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_IncFileFinder.inc.php';

$inc_file_finder = Admin_IncFileFinder::get_instance();

?>
<div id="header">
<?php
require $inc_file_finder->get_filename('body.div.header.title');
require $inc_file_finder->get_filename('body.div.header.tabs');
?>
</div>
