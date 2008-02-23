<?php
/**
 * The args for the add-admin-user script.
 *
 * @copyright Clear Line Web Design, 2007-08-07
 */

/*
 * Get the name, make sure that it is valid.
 */
if (isset($args['name'])) {
	$name = $args['name'];
} else {
	echo "Please enter the name: \n";
	$name = trim(fgets(STDIN));
}

#echo "$name\n"; exit;

$admin_login_manager = Admin_LoginManager::get_instance();

#print_r($admin_login_manager); exit;

while (TRUE) {
	try {
		#echo "Reached the try block\n"; exit;
		
		if ($admin_login_manager->is_name_valid($name)) {
			#echo "The name is valid.\n"; exit;
			
			if ($admin_login_manager->is_name_available($name)) {
				#echo "The name is acceptable\n."; exit;
				
				if (!$silent) {
					echo "$name is an acceptable new name.\n";
				}
				
				break;
			} else {
				echo "$name is not available.\n";
			}
		}
	} catch (InputValidation_InvalidInputException $e) {
		echo $e->getMessage() . "\n";
	}
	
	echo "Please try another name: \n";
	$name = trim(fgets(STDIN));
}

#echo "$name\n"; exit;

/*
 * Get the password.
 */
if (isset($args['password'])) {
	$password = $args['password'];
} else {
	echo "Please enter the password: \n";
	$password = trim(fgets(STDIN));
}

while (TRUE) {
	try {
		if ($admin_login_manager->is_password_valid($password)) {
			if (!$silent) {
				echo "$password is an acceptable new password.\n";
			}
			
			break;
		}
	} catch (InputValidation_InvalidInputException $e) {
		echo $e->getMessage() . "\n";
	}
	
	echo "Please try another password: \n";
	$password = trim(fgets(STDIN));
}

/*
 * Get the type of user.
 */
$type = '';
if (isset($args['type'])) {
	$type = $args['type'];
}

if (!$admin_login_manager->is_type_valid($type)) {
	
	if (strlen($type) > 0) {
		echo "Type not valid.\n";
	}
	
	$types = $admin_login_manager->get_user_types();
	$choice_str = join(' ', $types);

	$type = CLIScripts_InputReader::get_choice_from_string($choice_str);
	
	if ($type == NULL) {
		echo "Quitting!\n";
		exit;
	}
}

/*
 * Get the real name of the user.
 */
$real_name = '';
if (isset($args['real-name'])) {
	$real_name = $args['real-name'];
} else {
	echo "Please enter the real name of the user.\n";
	$real_name = trim(fgets(STDIN));
}

/*
 * Get the email address of the user.
 */
$email = '';
$got_valid_email = FALSE;
if (isset($args['email'])) {
	$email = $args['email'];
}

$validator = new InputValidation_EmailAddressValidator();

if (strlen($email) > 0) {
	try {
		$validator->validate($email);
		$got_valid_email = TRUE;
	} catch (InputValidation_InvalidInputException $e) {
		echo $e->getMessage() . "\n";
		$got_valid_email = FALSE;
	}
} else {
	$got_valid_email = FALSE;
}

if (!$got_valid_email) {
	$email
		= CLIScripts_InputReader
			::get_validated_input(
				"Please enter a valid email address: \n",
				$validator
			);
}

if (!$silent) {
	echo "The name: $name\n";
	echo "The password: $password\n";
	echo "The type: $type\n";
	echo "Real name: $real_name\n";
	echo "Email: $email\n";
}
?>