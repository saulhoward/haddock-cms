<?php
/**
 * If there's an error throw on the error page, too bad.
 *
 * @copyright Clear Line Web Design, 2007-07-30
 */

#echo '__FILE__: ' . __FILE__ . "\n";

$gvm = Caching_GlobalVarManager::get_instance();

$e = $gvm->get('exception');

echo $e->getMessage();
?>
