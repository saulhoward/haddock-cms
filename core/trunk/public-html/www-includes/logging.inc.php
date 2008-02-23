<?php
/**
 * Where any details about the current request are logged.
 *
 * @copyright Clear Lin Web Design, 2007-07-17
 */

try {
  $logger = new Logging_Logger();
  $logger->log();
} catch (Exception $e) {
  echo "Logging exception!\n";

  //echo 'print_r($e): ' . "\n";
  //  print_r($e);
//   exit;
}
?>