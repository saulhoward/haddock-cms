#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

create-new-haddock-project.pl

=head1 SYNOPSIS

    $ ./create-new-haddock-project.pl -p PROJECT -d DIR [-l PLUG-IN ...]

=head1 DESCRIPTION

Creates a new Haddock project.

If the trunk of Haddock has not been branched for this project yet,
this is done now.

Also, any plug-ins that need to be branched are branched here.

It then

- checks out the relevant repositories.
- Creates the .htaccess file.
- Creates the MySQL password directory and .INC file.

=head2 Options

=over 12

=item C<-p|--project>

The name of the project.

=item C<-d|--directory>

The directory we are using for the vhost.

=item C<-l|--plug-in>

Any plug-ins that this project uses.

item C<--mysql-username>

The username to connect to MySQL.

item C<--mysql-password>

The MySQL password.

item C<--mysql-database>

The MySQL database.

item C<--mysql-host>

The MySQL host.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-02

=cut

use Getopt::Long;
use Pod::Usage;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);
