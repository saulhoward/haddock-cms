#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

assemble-htaccess.pl

=head1 SYNOPSIS

    $ ./assemble-htaccess.pl -d DIR

=head1 DESCRIPTION

DEPRECATED!

Finds the various .htaccess fragments and assembles them into
one file.

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

Clear Line Web Design, 2007-07-02

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

# Find the htaccess fragment files.
my $htaccess = '';

# The core haddock file.
my $haddock_file = "$directory/haddock/FOR_public_html.htaccess";
$htaccess .= "## Start of core file.\n";
if (-f $haddock_file) {
    print STDERR "Core file: $haddock_file\n" if $debug;
    
    $htaccess .= `cat \"$haddock_file\"`;
}
$htaccess .= "## End of core file.\n";

# The plug-ins.
if (-d "$directory/plug-ins") {
    print STDERR "Plug-ins folder found!\n" if $debug;
    
    for (<$directory/plug-ins/*>) {
        if (-d $_) {
            print STDERR "$_ contains a plug-in.\n" if $debug;
            
            my $plug_in_name = basename($_);
            my $htaccess_file = "$_/FOR_public_html.htaccess";
            
            $htaccess .= "## Start of the $plug_in_name plug-in's file.\n";
            if (-f $htaccess_file) {
                print STDERR "Plug-in htaccess file: $htaccess_file\n" if $debug;
                
                $htaccess .= `cat \"$htaccess_file\"`;
            }
            $htaccess .= "## End of the $plug_in_name plug-in's file.\n";
        }
    }
} else {
    print STDERR "No plug-ins found!\n";
}

# The project-specific stuff.
my $project_specific_file = "$directory/project-specific/FOR_public_html.htaccess";
$htaccess .= "## Start of project-specific file.\n";
if (-f $project_specific_file) {
    print STDERR "Project specific htaccess file: $project_specific_file\n" if $debug;
    
    $htaccess .= `cat \"$project_specific_file\"`;
}
$htaccess .= "## End of project-specific file.\n";

# Save the file.
if ($ServerAdminScripts::debug) {
    print $htaccess;
} else {
    my $htaccess_file = "$directory/.htaccess";
    
    if (-f $htaccess_file) {
        die "$htaccess_file already exists!\n";
    } else {
        open HTA, ">$htaccess_file"
            or die "Unable to open $htaccess_file for writing!\n";
        
        print HTA $htaccess;
        
        close HTA;
    }
}
