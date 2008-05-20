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
			$e->getMessage() . "\n"
		);
		
		fprintf(
			STDERR,
			'Thrown at ' . date('c') . "\n"
		);
		
		fprintf(
			STDERR,
			"Exception trace: \n\n"
		);
		
		foreach ($e->getTrace() as $data) {
			fprintf(
				STDERR,
				"----------------------------------------\n"
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
								'"' . $datum . "\""
							);
						}
						
						fprintf(
							STDERR,
							"\n"
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
							'' . $data[$key] . "\n"
						);
				}
			}
			
			fprintf(
				STDERR,
				"----------------------------------------\n"
			);
		}
	}
}
?>