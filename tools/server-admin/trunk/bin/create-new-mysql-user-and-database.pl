#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

create-new-mysql-user-and-database.pl

=head1 SYNOPSIS

    $ ./create-new-mysql-user-and-database.pl -u UN -p PW -d DB -h HOST -r ROOT_PW

=head1 DESCRIPTION

What this script does...

=head2 Options

=over 12

=item C<-u|--username>

The MySQL user.

=item C<-p|--password>

The MySQL password.

=item C<-d|--database>

The name of the database.

If this is not set, the username is used.

=item C<-h|--host>

The host serving the database.

Default is C<localhost>.

=item C<-a|--accessing-host>

The host that from which we want to access the MySQL server.

Default is C<localhost>.

=item C<-r|--root-passsword>

The password of the root user on the MySQL server.

=item C<--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-02

=cut

use Getopt::Long;
use Pod::Usage;
use DBI;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

# Get the options from the user.
my ($username, $password, $database, $host, $accessing_host, $root_password, $help, $debug);

GetOptions(
    'u|username=s' => \$username,
    'p|password=s' => \$password,
    'd|database=s' => \$database,
    'h|host=s' => \$host,
    'a|accessing-host=s' => \$accessing_host,
    'r|root-password=s' => \$root_password,
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
    or $host = 'localhost';

defined($accessing_host)
    or $accessing_host = 'localhost';

defined($root_password)
    or die "The root password must be set with -r!\n";

# Connect to the database.
my $dsn = "DBI:mysql:database=mysql;host=$host;";

my $dbh = DBI->connect($dsn, 'root', $root_password);

# Create the database.
print_and_do_cmd("mysqladmin create \"$database\" -u root -p$root_password -h $host");

# Create the user.
my $create_user_statement = <<STM;
CREATE USER
    '$username'\@'$accessing_host'
IDENTIFIED BY
    '$password'
STM

print "$create_user_statement\n";

$dbh->do($create_user_statement);

# Access control.
my $grant_statement = <<STM;
GRANT
    SELECT,
    INSERT,
    UPDATE,
    DELETE
ON
    \`$database\`.*
TO
    '$username'\@'$accessing_host'
STM

print "$grant_statement\n";

$dbh->do($grant_statement);

$dbh->disconnect();
