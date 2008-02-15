#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

make-filename-web-safe.pl

=head1 SYNOPSIS

    $ ./make-filename-web-safe.pl -f FILE

=head1 DESCRIPTION

Looks at a file and renames it in the same directory with a name that
is URL safe.

=head2 Options

=over 12

=item C<-f|--file>

The file.

=item C<-d|--directory>

If a directory is given as an argument, then it is searched
and any files that are not web safe are made so.

If this is set, then C<-f> must not be set.

=item C<-h|--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-16

=cut

use Getopt::Long;
use Pod::Usage;
use File::Basename;

use FindBin qw($Bin);
use lib "$Bin/../lib";

#if ($^O eq 'MSWin32') {
#    require Win32;
#}

use ServerAdminScripts qw(print_and_do_cmd);

# Get the options from the user.
my ($file, $directory, $help, $debug);

GetOptions(
    'f|file:s' => \$file,
    'd|directory:s' => \$directory,
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
my @files;

if (defined($file)) {
    if (defined($directory)) {
        die "If the file is defined, the directory must not be defined!\n";
    }
    
    # Get the base and dir name.
    my $dirname = File::Basename::dirname($file);
    my $basename = File::Basename::basename($file);
    
    chdir($dirname);
    
    push @files, $basename;
}

if (defined($directory)) {
    if (defined($file)) {
        die "If the directory is defined, the file must not be defined!\n";
    }
    
    chdir($directory);
    
    for (<*>) {
        if (/\s+/) {
            push @files, $_;
        }
    }
}

for my $file (@files) {
    (-f $file)
        or die "$file does not exist!\n";
    
    # Make safe.
    my $new_file_name = $file;
    $new_file_name =~ s/\s+/_/g;
    
    # Save
    print_and_do_cmd("mv \"$file\" $new_file_name");
}

#if ($^O eq 'MSWin32') {
#    $dirname = Win32::GetShortPathName($dirname);
#}


