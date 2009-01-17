<?php
/**
 * CLIScripts_ExceptionsHelper
 *
 * @copyright 2008-05-20, RFI
 */

class
	CLIScripts_ExceptionsHelper
{
	public static function
		render_exception_trace(
			Exception $e
		)
	{
		fprintf(
			STDERR,
			get_class($e) . ' thrown at ' . date('c') . PHP_EOL
		);
		
		fprintf(
			STDERR,
			$e->getMessage() . PHP_EOL
		);
		
		$trace = $e->getTrace();
		
		if (count($trace) > 0) {
			fprintf(
				STDERR,
				'Exception trace:' . PHP_EOL . PHP_EOL
			);
			
			foreach ($trace as $data) {
				fprintf(
					STDERR,
					'----------------------------------------' . PHP_EOL
				);
				
				$keys = array_keys($data);
				
				sort($keys);
				 
				foreach ($keys as $key) {
					fprintf(
						STDERR,
						"$key: "
					);
					
					if (is_array($data[$key])) {
						foreach ($data[$key] as $datum) {
							fprintf(
								STDERR,
								'    '
							);
							
							if (is_numeric($datum) || is_string($datum)) {
								fprintf(
									STDERR,
									'"' . $datum . '"'
								);
							}
							
							fprintf(
								STDERR,
								PHP_EOL
							);
						}
						
					} else if (strtolower($key) == 'file') {
							$formatted_filename
								= new Formatting_FileName(
									$data[$key]
								);
							
							fprintf(
								STDERR,
								$formatted_filename->get_pretty_name()
							);
					} else {
							fprintf(
								STDERR,
								'    '
							);
							
							fprintf(
								STDERR,
								'' . $data[$key] . PHP_EOL
							);
					}
				}
				
				fprintf(
					STDERR,
					'----------------------------------------' . PHP_EOL
				);
			}
		}
	}
}
?>