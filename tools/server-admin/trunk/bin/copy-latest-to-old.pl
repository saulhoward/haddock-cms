#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

copy-latest-to-old.pl

=head1 SYNOPSIS

    ./copy-latest-to-old.pl -d DIR

=head1 DESCRIPTION

Searches the given directory for files called
"latest.dump" and copies them to a directory called
"old" in the same directory.

The name of the file is changed from "latest.dump" to
"<TIMESTAMP>.dump" when the file is copied.

If there is no directory called "old", one is created.

If a file already exists in the "old" directory, then copying
is skipped.

=head2 Options

=over 12

=item C<-d|--directory>

The directory to search.

=item C<-h|--help>

Print this message and exit.

=item C<--debug>

Just print the commands but don't run them.

=item C<--silent>

Don't print anything while running.

=back

=head1 AUTHOR

RFI

=head1 COPYRIGHT

Clear Line Web Design, 2007-06-17

=cut

# Get the options from the user.

use Getopt::Long;
use Pod::Usage;
use File::Find;
use File::stat;

my ($dir, $help, $debug, $silent);

GetOptions(
    'd|directory=s' => \$dir,
    'h|help' => \$help,
    'debug' => \$debug,
    'silent' => \$silent
);

if (defined($help)) {
    pod2usage(-verbose => 2);
}

defined($dir)
    or die "Please give me a directory!\n";

(-d $dir)
    or die "$dir is not a directory!\n";

finddepth(
    sub
    {
        if (-f $File::Find::name) {
            if ($_ eq 'latest.dump') {
                print 'Latest: ', $File::Find::name, "\n" unless $silent;
                
                # Is there an "old" directory?
                my $old_dir = $File::Find::dir . '/old';
                unless (-d $old_dir) {
                    print "mkdir $old_dir\n" unless $silent;
                    
                    mkdir $old_dir unless $debug;
                }
                
                # Is there a file there already?
                my $latest_stat = stat($File::Find::name);
                my $copy_to_name = $File::Find::dir . '/old/' . $latest_stat->mtime . '.dump';
                
                if (-f $copy_to_name) {
                    print "$copy_to_name already exists!\n" unless $silent;
                } else {
                    my $cmd = 'cp ' . $File::Find::name . ' ' . $copy_to_name;
                    
                    print "$cmd\n" unless $silent;
                    
                    system $cmd unless $debug;
                }
            }
            
            #print $File::Find::name, "\n";
            #print "$_\n";
            #
            #print "\n";
        }
    },
    ($dir)
);