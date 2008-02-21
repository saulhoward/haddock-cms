#!/usr/bin/perl -w

use strict;
use warnings;

=head1 NAME

show-haddock-reposes.pl

=head1 SYNOPSIS

    $ ./show-haddock-reposes.pl -d DIR

=head1 DESCRIPTION

Finds out which repositories have been checked out
for this project.

=head2 Options

=over 12

=item C<-d|--directory>

The directory containing the haddock project.

Default: C<.>

=item C<-h|--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

RFI, 2008-01-06

=cut

use Getopt::Long;
use Pod::Usage;
use File::Basename;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

if ($^O eq 'MSWin32') {
    require Win32;
}

# Get the options from the user.
my ($directory, $help, $debug);

GetOptions(
    'd|directory=s' => \$directory,
    'h|help' => \$help,
    'debug' => \$debug
);

if (defined($help)) {
    pod2usage(-verbose => 2);
}

$ServerAdminScripts::debug = $debug;

if ($ServerAdminScripts::debug) {
    print STDERR "Running in debug mode.\n";
}

# Check the user's input.
defined($directory)
    #or die "The directory must be set with -d!\n";
    or $directory = '.';

$directory =~ s{/$}{};

if ($^O eq 'MSWin32') {
    $directory = Win32::GetShortPathName($directory);
}

(-d $directory)
    or die "$directory is not a directory!\n";

print STDERR "Directory: $directory\n" if $debug;

# Show the URL of the directories.

show_url_of_wd("$directory/haddock");

for (<$directory/plug-ins/*>) {
	show_url_of_wd($_);	
}

show_url_of_wd("$directory/project-specific");

# subs

sub show_url_of_wd
{
	my $wd = shift;
	
	if (-d $wd) {
		my $cmd = "svn info $wd | grep \"^URL: \"";
		
		print_and_do_cmd($cmd);
	} else {
		warn "No directory called $wd!\n";
	}
}
