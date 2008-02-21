#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

download-mysql-dumps.pl

=head1 SYNOPSIS

    $ ./download-mysql-dumps.pl -f FILE -d DIR

=head1 DESCRIPTION

Parses a CSV file containing details for different servers
and then downloads MySQL dump files from those machines.

=head2 Options

=over 12

=item C<-f|--server-file>

The CSV file containing the connection details.

=item C<-d|--dump-dir>

The directory to dump the files into.

=item C<--debug>

Just print the commands but don't run them.

=back

=head1 AUTHOR

RFI

=head1 COPYRIGHT

Clear Line Web Design, 2007-06-17

=cut

# Get the options from the user.

use Getopt::Long;

my ($servers_file, $dump_dir, $debug);

GetOptions(
    'f|servers-file=s' => \$servers_file,
    'd|dump-dir=s' => \$dump_dir,
    'debug' => \$debug
);

#die "Please give me a file with a list of servers!\n"
$servers_file = 'servers.csv'
    unless defined $servers_file;
    
(-f $servers_file)
    or die "$servers_file is not a file! Set with -f.\n";

defined($dump_dir)
    or $dump_dir = '.';

(-d $dump_dir)
    or die "$dump_dir is not a directory!\n";

$dump_dir =~ s{/$}{};

# Get the list of servers from the file.

my @servers = ();
open SRV, "<$servers_file"
    or die "Couldn't open $servers_file!\n";

for (<SRV>) {
    chomp;
    
    if (length $_ > 0) {
        unless (/^\s*#/) {
            my @CSVs = split /,/;
            my %CSVs;
            
            $CSVs{remote_host} = shift @CSVs;
            $CSVs{remote_dir} = shift @CSVs;
            $CSVs{remote_user} = shift @CSVs;
            $CSVs{local_relative_dir} = shift @CSVs;
            
            push @servers, \%CSVs;
        }
    }
}

# Download the latest dump files from the server.
foreach my $server (@servers) {
    my %server = %$server;
    
    my $servers_dump_dir = "$dump_dir/$server{local_relative_dir}";
    
    my $cmd = "rsync -az \"$server{remote_user}\@$server{remote_host}:$server{remote_dir}\" \"$servers_dump_dir\"";
    
    if ($debug) {
        print "$cmd\n";
    } else {
        system $cmd;
    }
}
