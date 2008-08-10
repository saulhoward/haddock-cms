<?php
/**
 * Database_DatabaseClassFactoryTests
 *
 * @copyright 2007-03-21, RFI
 */
    
class
    Database_DatabaseClassFactoryTests
extends
    UnitTests_UnitTests
{
    #public static function
    #    test_get_database_class_returns_reflection_class()
    #{
    #    $database_class_factory = Database_DatabaseClassFactory::get_instance();
    #    
    #    $database_class = $database_class_factory->get_database_class();
    #    
    #    return is_a($database_class, 'ReflectionClass');
    #}
    #
    #public static function
    #    test_get_database_class_returns_database_reflection_class()
    #{
    #    $database_class_factory = Database_DatabaseClassFactory::get_instance();
    #    
    #    $database_class = $database_class_factory->get_database_class();
    #    
    #    $mysql_user_factory = Database_MySQLUserFactory::get_instance();
    #    
    #    $mysql_user = $mysql_user_factory->get_for_this_project();
    #    
    #    $passwords_file = $mysql_user->get_password_file();
    #    
    #    $database_object = $database_class->newInstance(
    #        $mysql_user,
    #        $passwords_file->get_database()
    #    );
    #    
    #    return is_a($database_object, 'Database_Database');
    #}
}
?>