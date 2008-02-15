#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

check-out-haddock-plug-ins.pl

=head1 SYNOPSIS

    $ ./check-out-haddock-plug-ins.pl -p PROJECT -d DIR

=head1 DESCRIPTION

Checks out the plug-ins for a haddock project.

=head2 Options

=over 12

=item C<-p|--project>

The project.

=item C<-d|--directory>

The directory where we are going to check out the working dirs.

Default: C<.>

=item C<-u|--url>

The URL of the repository.

Default: https://svn.clearlinewebdesign.com/repos

=item C<-h|--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-11

=cut

use Getopt::Long;
use Pod::Usage;

use FindBin qw($Bin);
use lib "$Bin/../lib";

if ($^O eq 'MSWin32') {
    require Win32;
  }

use ServerAdminScripts qw(print_and_do_cmd);

# Get the options from the user.
my ($project, $directory, $url, $help, $debug);

GetOptions(
    'p|project=s' => \$project,
    'd|directory=s' => \$directory,
    'u|url=s' => \$url,
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
defined($project)
    or die "The project must be set with -p!\n";
    
defined($directory)
    #or die "The directory must be set with -d!\n";
    or $directory = '.';

$directory =~ s{/$}{};
$directory =~ s/\\/\//g;

if ($^O eq 'MSWin32') {
    $directory = Win32::GetShortPathName($directory);
}

print STDERR "The directory: $directory\n" if $debug;

(-d $directory)
    or die "$directory is not a directory!\n";

defined($url)
    or $url = 'https://svn.clearlinewebdesign.com/repos';

print STDERR "The Repos URL: $url\n" if $debug;

# Is there a list of plug-ins?
my $plug_in_list_file = "$directory/project-specific/config/plug-ins.txt";
if (-f $plug_in_list_file) {
    open PIL, "<$plug_in_list_file"
        or die "Unable to open $plug_in_list_file! $!\n";
    
    my @plug_ins = ();
    
    for (<PIL>) {
        unless (/^\s*#/ or /^\s*$/) {
            s/\s*$//;
            
            push @plug_ins, $_;
        }
    }
    
    close PIL;
    
    if (scalar @plug_ins > 0) {
        my $plug_in_directory = "$directory/plug-ins";
        
        if (-d $plug_in_directory) {
            print STDERR "$plug_in_directory already exists!\n";
        } else {
            print_and_do_cmd("mkdir \"$plug_in_directory\"");
        }
    } else {
        print STDERR "No plug-ins listed in $plug_in_list_file!\n";
    }
    
    # Check out all the plug-ins.
    foreach my $plug_in (@plug_ins) {
        print "Plug-in: $plug_in\n";
        
        my $plug_in_directory = "$directory/plug-ins/$plug_in";
        if (-d $plug_in_directory) {
            print STDERR "$plug_in_directory already exists!\n";
        } else {
            print_and_do_cmd("mkdir \"$plug_in_directory\"");
            
            my $plug_in_url = $url . '/plug-ins/' . $plug_in . '/branches/' . $project;
            
            print 'Checking out ', $plug_in_url, ".\n";
            
            print_and_do_cmd("svn co $plug_in_url \"$plug_in_directory\"");
        }
    }
} else {
    print STDERR "No plug-in file!\n";
}
