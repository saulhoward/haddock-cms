#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

delete-old-dump-files.pl

=head1 SYNOPSIS

    $ ./delete-old-dump-files.pl -d DIR -j DAYS

=head1 DESCRIPTION

Looks at the content of an C<old> directory and deletes
the dump files that are more than C<DAYS> days old.

The C<old> should have been populated by the C<copy-latest-to-old.pl>
script.

=head2 Options

=over 12

=item C<-d|--directory> DIR

The directory containing the old dump files.

=item C<-j|--days> DAYS

The cut off for deleting is DAYS days ago.

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
use POSIX qw(strftime);

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

# Get the options from the user.
my ($directory, $days, $help, $debug);

GetOptions(
    'd|directory=s' => \$directory,
    'j|days=i' => \$days,
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
    or die "The directory must be set with --directory!\n";

$directory =~ s{/$}{};

(-d $directory)
    or die "$directory is not a directory!\n";

print STDERR "The directory: $directory\n" if $debug;

defined($days)
    or die "The number of days must be set with -j!\n";

($days =~ /^\d+$/)
    or die "$days is not an integer!\n";

($days > 0)
    or die "$days is not greater than zero!\n";
    
print STDERR "The number of days: $days\n" if $debug;

my $cut_off = time() - (24 * 60 * 60 * $days);

if ($debug) {
    print STDERR "The cut off: $cut_off\n";
    print STDERR "The cut off (human): ", strftime('%c', gmtime($cut_off)), "\n";
}

# Let's work in the directory.
chdir $directory;

# Get the list of files.
my @dump_files;
foreach my $file (<*>) {
    if (-f $file) {
        if ($file =~ /^(\d+)\.dump/) {
            my %file_data;
            
            $file_data{name} = $file;
            $file_data{created} = $1;
            
            $file_data{delete} = ($file_data{created} < $cut_off) ? 'yes' : 'no';
            
            push @dump_files, \%file_data;
        }
    }
}

if ($debug) {
    print STDERR "All dump files found:\n";
    
    for (@dump_files) {
        print STDERR '-' x 10, "\n";
        
        my %file_data = %{$_};
        
        for (sort keys %file_data) {
            print STDERR "$_: $file_data{$_}\n";
        }
        
        print STDERR 'Created (human): ', strftime('%c', gmtime($file_data{created})), "\n";
        
        print STDERR '-' x 10, "\n";
    }
}

# Find the files older than the cut off.
foreach (@dump_files) {
    my %file_data = %{$_};
    
    if ($file_data{delete} eq 'yes') {
        print_and_do_cmd("rm $file_data{name}");
    }
}