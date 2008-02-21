<?php
/**
 * PublicHTML_AJAXFormHelper
 *
 * @copyright RFI, 2008-01-11
 */

class
	PublicHTML_AJAXFormHelper
{
	/*
	 * ----------------------------------------
	 * Functions to do with sessions set in forms.
	 * ----------------------------------------
	 */
	
	public static function
		reset_session_values($fields)
	{
		if (!isset($_SESSION['values'])) {
			foreach ($fields as $field) {
				$_SESSION['values'][$field] = '';
			}
		}
	}
	
	public static function
		reset_session_errors($fields)
	{
		if (!isset($_SESSION['errors'])) {
			foreach ($fields as $field) {
				$_SESSION['errors'][$field]['class'] = 'hidden';
				$_SESSION['errors'][$field]['message'] = '';
			}
		}		
	}
	
	public static function
		reset_session_form($fields)
	{
		self::reset_session_values($fields);
		self::reset_session_errors($fields);		
	}
		
	public static function
		unset_form_session()
	{
		if (isset($_SESSION['values'])) {
			unset($_SESSION['values']);
		}
		
		if (isset($_SESSION['errors'])) {
			unset($_SESSION['errors']);
		}		
	}
	
	/*
	 * ----------------------------------------
	 * Functions to do with validating fields.
	 * ----------------------------------------
	 */
	
	/**
	 * Validates a single field.
	 *
	 * The assumption is that there is a public static function in the
	 * helper class with a name beginnig 'validate_'.
	 */
	public function
		validate_field(
			$helper_class_name,
			$field_id,
			$input_value
		)
	{
		$callback_function_name = 'validate_' . $field_id;
		
		$callback = $helper_class_name . '::' . $callback_function_name;
		
		#echo "\$callback: $callback\n";
		#exit;
		
		#$callback_response = call_user_func($callback, $input_value);
		
		$args = array();
		
		$args['value'] = $input_value;
		
		$callback_response
			= self
				::static_class_function_callback_using_reflection(
					$helper_class_name,
					$callback_function_name,
					$args
				);
		
		#echo "\$callback_response: $callback_response\n";
		
		return $callback_response;
	}
	
	/**
	 * Renders the response the AJAX call made in 'ajax-form.js'.
	 */
	public static function
		render_validator_xml_response(
			$helper_class_name
		)
	{
#		echo __METHOD__ . "\n"; print_r($_POST); exit;
		
		/*
		 * AJAX validation is performed by the validate_field method.
		 * The results are used to form an XML document that is sent back
		 * to the client.
		 */
		$field_response = self::validate_field(
			$helper_class_name,
			$_POST['field_id'],
			$_POST['input_value']
		);
		
		#echo "\$field_response: $field_response\n";
		#exit;
		
		$field_id = $_POST['field_id'];

		#echo "\$field_id: $field_id\n";
		#exit;
		
		$response = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<response>
	<result>$field_response</result>
	<field_id>$field_id</field_id>
</response>
XML;
		
		header('Content-Type: text/xml');
		
		echo $response;
	}
  
	public static function
		validate_non_zero_length($value, $field)
	{
		if (strlen($value) > 0) {
			return 'Success';
		} else {
			return "Please enter $field.";
		}
	}
	
	/**
	 * Validates all form fields on form submit.
	 *
	 * It then adds the values to the database.
	 */
	public function
		attempt_submit(
			$helper_class_name,
			$validation_errors_exist_url,
			$no_validation_errors_function_name,
			$validator_class_name = NULL
		)
	{
		#echo __METHOD__ . "\n"; exit;
		
		#echo "Attempting to submit\n";
		#print_r($_POST);
		#exit;
		
		// error flag, becomes 1 when errors are found.
		$errors_exist = FALSE;
		
		self::unset_form_session();
		
		#$fields_callback = $helper_class_name . '::get_fields';
		#$fields = call_user_func($helper_class_name . '::get_fields');
		#$helper_class_reflection_object = new ReflectionClass($helper_class_name);
		#
		##print_r($helper_class_reflection_object);
		#
		##print_r($helper_class_reflection_object->getMethods());
		#
		#$get_fields_reflection_method = $helper_class_reflection_object->getMethod('get_fields');
		#
		##print_r($get_fields_reflection_method);
		#
		#$fields = $get_fields_reflection_method->invoke(NULL);
		
		$fields = self::static_class_function_callback_using_reflection($helper_class_name, 'get_fields');
		
		#$gfrf = new ReflectionFunction($helper_class_name . '::get_fields');
		
		#print_r($gfrf);
		
		#print_r($fields); exit;
		
		self::reset_session_form($fields);
		
		if (!isset($validator_class_name)) {
			$validator_class_name = $helper_class_name;
		}
		
		foreach ($fields as $field) {
			$_SESSION['values'][$field] = $_POST[$field];
			
			$response = self::validate_field(
				$validator_class_name,
				$field,
				$_POST[$field]
			);
			
			if ($response != 'Success') {
				#echo "\$response: $response\n";
				
				$_SESSION['errors'][$field]['class'] = 'error';
				$_SESSION['errors'][$field]['message'] = $response;
				$errors_exist = TRUE;
			}
		}
		
		/*
		 * If no errors are found, point to a successful validation page.
		 */
		if ($errors_exist) {
			#echo "Errors exist!\n"; exit;
			
			return $validation_errors_exist_url;
		} else {
			#echo "No errors.\n"; exit;
			
			self::unset_form_session();
			
			#return call_user_func($helper_class_name . '::' . $no_validation_errors_function_name, $_POST);
			$post_array = array();
			$post_array[] = $_POST;
			return
				self::static_class_function_callback_using_reflection(
					$helper_class_name,
					$no_validation_errors_function_name,
					$post_array
				);
		}
	}
	
	public static function
		render_head_script_javascript($settings_ajax_file_name)
	{
?>
<script
	type="text/javascript"
	src="<?php echo $settings_ajax_file_name; ?>"
></script>
<script
	type="text/javascript"
	src="/haddock/public-html/public-html/scripts/ajax-form.js"
></script>
<?php
	}
	
	/**
	 * Why is it necessary to do this on debian?
	 *
	 * This is meant to work a bit like call_user_func.
	 */
	public static function
		static_class_function_callback_using_reflection(
			$class_name,
			$function_name,
			$args = NULL
		)
	{
		$debug = TRUE;
		$debug = FALSE;
		
		if ($debug) {
			echo "\n----------------------------------------\n";
			
			echo __METHOD__ . "\n";
			
			echo "Class: $class_name\n";
			echo "Function: $function_name\n";
			echo "Args: \n";
			
			print_r($args);
		}
		
		$class_reflection_object = new ReflectionClass($class_name);
		
		$reflection_method = $class_reflection_object->getMethod($function_name);
		
		if ($debug) {
			print_r($class_reflection_object);
			
			print_r($reflection_method);
		}
		
		$returned_values = NULL;
		
		if (isset($args)) {
			$returned_values = $reflection_method->invokeArgs(NULL, $args);
		} else {
			$returned_values = $reflection_method->invoke(NULL);
		}
		
		if ($debug) {
			print_r($returned_values);
			
			echo "\n----------------------------------------\n";
		}
		
		return $returned_values;
	}
}
?>