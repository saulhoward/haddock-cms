#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

branch-svn-directory.pl

=head1 SYNOPSIS

    $ ./branch-svn-directory.pl -p PROJECT

=head1 DESCRIPTION

Branches a directory under SVN.

=head2 Options

=over 12

=item C<-p|--project>

The name of the project.

=item C<-b|--branch>

The name of the branch.

=item C-u|--url>

The URL of the repos.

Default: https://svn.clearlinewebdesign.com/repos

=item C<-d|--directory>

The working directory where this project is checked out.

Default: /home/clwd/svn/ragnar/repos

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
my ($project, $branch, $url, $help, $debug);

GetOptions(
    'p|project=s' => \$project,
    'b|branch=s' => \$branch,
    'u|url=s' => \$url,
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

defined($branch)
    or die "The branch must be defined with -b!\n";

defined($url)
    or $url = 'https://svn.clearlinewebdesign.com/repos';

defined($directory)
    or $directory = '/home/clwd/svn/ragnar/repos';

(-d $directory)
    or die "$directory is not a directory!\n";

# Check that the branch of this project does not already exist.
chdir "$directory/$project";
print_and_do_cmd("svn up");
if (-d "branches/$branch") {
    die "There is already a branch for $branch!\n";
} else {
    # Branch the project.
    print_and_do_cmd("svn copy $url/$project/trunk $url/$project/branches/$branch -m \"Creating a branch of $project for $branch.\"");
}
