#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

split-haddock-htaccess.pl

=head1 SYNOPSIS

    $ ./split-haddock-htaccess.pl

=head1 DESCRIPTION

Splits a haddock .htaccess file and saves the fragments in the
the appropriate folders.

Existing files are silently overwritten.

See C<assemble-htaccess.pl>

=head2 Options

=over 12

=item C<-d|--directory>

The directory containing the haddock project.

=item C<-h|--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-03

=cut

use Getopt::Long;
use Pod::Usage;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

if ($^O eq 'MSWin32') {
    use Win32;
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
    or die "The directory must be set with -d!\n";

(-d $directory)
    or die "$directory is not a directory!\n";

if ($^O eq 'MSWin32') {
    $directory = Win32::GetShortPathName($directory);
}

# Read the file.
my $htaccess_file = "$directory/.htaccess";
my $core_htaccess_file = '';
my %plug_in_htaccess_files;
my $ps_htaccess_file = '';
if (-f $htaccess_file) {
    open HTA, "<$htaccess_file"
        or die "Unable to open $htaccess_file for reading!\n";
    
    my %read_state;
    foreach my $htaccess_line (<HTA>) {
        chomp $htaccess_line;
        
        if ($htaccess_line eq '## Start of core file.') {
            $read_state{hc} = 1;
            next;
        }
        
        if ($read_state{hc}) {
            if ($htaccess_line eq '## End of core file.') {
                $read_state{hc} = 0;
                next;
            }
            
            $core_htaccess_file .= "$htaccess_line\n";
            next;
        }
        
        if ($htaccess_line =~ /## Start of the (.+) plug-in's file./) {
            $read_state{pi} = $1;
            next;
        }
        
        if ($read_state{pi}) {
            if ($htaccess_line eq "## End of the $read_state{pi} plug-in's file.") {
                $read_state{pi} = 0;
                next;
            }
            
            $plug_in_htaccess_files{$read_state{pi}} .= "$htaccess_line\n";
            next;
        }
        
        if ($htaccess_line eq '## Start of project-specific file.') {
            $read_state{ps} = 1;
            next;
        }
        
        if ($read_state{ps}) {
            if ($htaccess_line eq '## End of project-specific file.') {
                $read_state{ps} = 0;
                next;
            }
            
            $ps_htaccess_file .= "$htaccess_line\n";
            next;
        }
    }
    
    close HTA;
} else {
    die "$htaccess_file does not exist!\n";
}

# Save the files.
if ($debug) {
    print STDERR "The core htaccess file:\n";
    
    print STDERR $core_htaccess_file;
} else {
    open HTA, ">$directory/haddock/FOR_public_html.htaccess"
        or die "Unable to open $directory/haddock/FOR_public_html.htaccess for writing! $!\n";
    
    print HTA $core_htaccess_file;
    
    close HTA;
}

for (sort keys %plug_in_htaccess_files) {
    if ($debug) {
        print STDERR "The $_ plug-in's htaccess file:\n";
        
        print STDERR $plug_in_htaccess_files{$_};
    } else{
        open HTA, ">$directory/plug-ins/$_/FOR_public_html.htaccess"
            or die "Unable to open $directory/plug-ins/$_/FOR_public_html.htaccess for writing! $!\n";
        
        print HTA $plug_in_htaccess_files{$_};
        
        close HTA;
    }
}

if ($debug) {
    print STDERR "The project-specific htaccess file:\n";
    
    print STDERR $ps_htaccess_file;
} else {
    open HTA, ">$directory/project-specific/FOR_public_html.htaccess"
        or die "Unable to open $directory/project-specific/FOR_public_html.htaccess for writing! $!\n";
    
    print HTA $ps_htaccess_file;
    
    close HTA;
}
