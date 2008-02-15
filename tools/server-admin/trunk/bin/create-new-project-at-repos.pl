#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

create-new-project-at-repos.pl

=head1 SYNOPSIS

    $ ./create-new-project-at-repos.pl -p PROJECT

=head1 DESCRIPTION

Creates a new project at an SVN repository.

=head2 Options

=over 12

=item C<-p|--project>

The name of the project.

=item C<-d|--directory

The working directory where the projects are stored.

Default: /home/clwd/svn/ragnar/repos/projects

=item C<-h|--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-02

=cut

use Getopt::Long;
use Pod::Usage;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

# Get the options from the user.
my ($project, $directory, $help, $debug);

GetOptions(
    'p|project=s' => \$project,
    'd|directory=s' => \$directory,
    'h|help' => \$help,
    'debug' => \$debug
);

if (defined($help)) {
    pod2usage(-verbose => 2);
}

$ServerAdminScripts::debug = $debug;

if ($ServerAdminScripts::debug) {
    print "Running in debug mode.\n";
}

defined($project)
    or die "The project must be set with -p!\n";

($project =~ /^[a-z-]+$/)
    or die "The project name must contain only lower case letters and hyphens!\n";

defined($directory)
    or $directory = '/home/clwd/svn/ragnar/repos/projects';

(-d $directory)
    or die "$directory is not a directory!\n";

# Make the directory.
my $project_directory = "$directory/$project";

if (-d $project_directory) {
    die "$project_directory already exists!\n";
} else {
    print_and_do_cmd("mkdir $project_directory");
    print_and_do_cmd("mkdir $project_directory/trunk");
}

# Add it to SVN.
print_and_do_cmd("svn add $project_directory");

# Check it in.
chdir($project_directory);
print_and_do_cmd("svn ci -m \"Adding the $project project.\"");
