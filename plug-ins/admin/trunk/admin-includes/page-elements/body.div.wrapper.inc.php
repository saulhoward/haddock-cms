<?php
/**
 * The wrapper div in the body of an admin page.
 *
 * @copyright Clear Line Web Design, 2006-02-16
 */

require_once PROJECT_ROOT . '/haddock/admin/classes/Admin_IncFileFinder.inc.php';

$inc_file_finder = Admin_IncFileFinder::get_instance();

?>
<div id="wrapper">
<?php
if ($http_error > 0) {
    require PROJECT_ROOT . '/haddock/public-html/public-includes/http-errors/' . $http_error . '.inc.php';
} elseif (isset($error_message)) {
    require $inc_file_finder->get_filename('body.div.error');
} else {
    try {
        require $inc_file_finder->get_filename('body.div.content');
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        require $inc_file_finder->get_filename('body.div.error');
    }
}
?>
</div>
