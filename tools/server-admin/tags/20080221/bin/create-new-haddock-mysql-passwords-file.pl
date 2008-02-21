#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

create-new-haddock-mysql-passwords-file.pl

=head1 SYNOPSIS

    $ ./create-new-haddock-mysql-passwords-file.pl -u UN -p PW -d DB -h HOST --directory DIR

=head1 DESCRIPTION

Creates a new passwords file for a haddock project.

=head2 Options

=over 12

=item C<-u|--username>

The MySQL user.

=item C<-p|--password>

The MySQL password.

=item C<-d|--database>

The name of the database.

Default: the given username.

=item C<-h|--host>

The host serving the database.

Default: C<localhost>

=item C<--directory>

The doc root directory.

Default: C<.>

=item C<--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-06-29

=cut

use Getopt::Long;
use Pod::Usage;
use POSIX qw(strftime);

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

if ($^O eq 'MSWin32') {
    require Win32;
}

# Get the options from the user.
my ($username, $password, $database, $host, $directory, $help, $debug);

GetOptions(
    'u|username=s' => \$username,
    'p|password=s' => \$password,
    'd|database=s' => \$database,
    'h|host=s' => \$host,
    'directory=s' => \$directory,
    'help' => \$help,
    'debug' => \$debug
);

if (defined($help)) {
    pod2usage(-verbose => 2);
}

$ServerAdminScripts::debug = $debug;

if ($ServerAdminScripts::debug) {
    print "Running in debug mode.\n";
}

# Check the user's input.
defined($username)
    or die "The username must be set with -u!\n";

defined($password)
    or die "The password must be set with -p!\n";

defined($database)
    #or die "The database must be set with -d!\n";
    or $database = $username;

defined($host)
    #or die "The host must be set with -h!\n";
    or $host = 'localhost';

defined($directory)
    #or die "The directory must be set with --directory!\n";
    or $directory = '.';

$directory =~ s{/$}{};

if ($^O eq 'MSWin32') {
    $directory = Win32::GetShortPathName($directory);
}

(-d $directory)
    or die "$directory is not a directory!\n";

print STDERR "The directory: $directory\n" if $debug;

# Create the passwords directory if necessary.
if (-d "$directory/passwords") {
    print "The passwords directory already exists.\n";
} else {
    print_and_do_cmd("mkdir \"$directory/passwords\"");
}

# Create a date string.
my $date = strftime "%Y-%m-%d", gmtime;

# Write the .htaccess file.
if (-f "$directory/passwords/.htaccess") {
    print "The .htaccess file for the passwords directory already exists.\n";
} else {    
    my $htaccess = <<HTACCESS;
# Restrict Access to the passwords folder.
# © Clear Line Web Design,  $date

Order Deny,Allow
Deny from all

HTACCESS
    
    if ($debug) {
        print $htaccess;
    } else {
        open HTA, ">$directory/passwords/.htaccess"
            or die "Unable to open $directory/passwords/.htaccess for writing!\n";
        
        print HTA $htaccess;
        
        close HTA;
    }
}

# Write the passwords .INC file.
if (-f "$directory/passwords/passwords.inc.php") {
    print "The passwords file already exists.\n";
} else {    
    my $pw_file = <<PWFILE;
<?php
/**
 * Passwords for accessing $database on $host.
 *
 * \@copyright Clear Line Web Design, $date
 */

define(DB_USERNAME, '$username');
define(DB_PASSWORD, '$password');
define(DB_DATABASE, '$database');
define(DB_HOST, '$host');

?>
PWFILE
    
    if ($debug) {
        print $pw_file;
    } else {
        open PWF, ">$directory/passwords/passwords.inc.php"
            or die "Unable to open $directory/passwords/passwords.inc.php for writing!\n";
        
        print PWF $pw_file;
        
        close PWF;
    }
}
