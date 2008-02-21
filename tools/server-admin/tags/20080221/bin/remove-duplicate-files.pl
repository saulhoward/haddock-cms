#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

remove-duplicate-files.pl

=head1 SYNOPSIS

    ./remove-duplicate-files.pl -d DIR [-l|--list]

=head1 DESCRRIPTION

Removes duplicate files from a directory.

=head2 Options

=over 12

=item C<-d|--dir>

The directory to search.

=item C<-l|--list>

Just list the duplicates but don't delete anything.

=back

=head1 AUTHOR

RFI

=head1 COPYRIGHT

Clear Line Web Design, 2007-06-17

=head1 LICENSE

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

http://www.gnu.org/licenses/gpl.txt

=cut

use Getopt::Long;
use File::stat;

#
#
#my $dir = $ARGV[0];

my ($dir, $list);

GetOptions (
    'd|dir=s' => \$dir,
    'l|list' => \$list
);

defined($dir)
    or die "The directory must be set with -d!\n";

(-d $dir)
    or die "$dir is not a directory!\n";

chdir $dir;

# Get the checksums.
my %files;
for (<*>) {
    if (-f $_) {
        $files{$_} = `md5sum $_`;
        $files{$_} =~ s/(?<=[0-9a-f]{32}) \*.+$//;
        
        chomp $files{$_};
    }
}

# Group by checksum.
my %checksums;
for (sort keys %files) {
    #print "$_: $files{$_}\n";
    push @{$checksums{$files{$_}}}, $_;
}

# Sort by date and delete newer files..
for (sort keys %checksums) {
    @{$checksums{$_}} = sort
        {
            my $a_stat = stat($a);
            my $b_stat = stat($b);
            $a_stat->mtime <=> $b_stat->mtime;
        } @{$checksums{$_}};
    
    if ($list) {
        print "$_:\n";
        
        for (@{$checksums{$_}}) {
            print "\t$_\n";
        }
        
        print "\n";
    } else {
        shift @{$checksums{$_}};
        
        unlink @{$checksums{$_}};
    }
    
}
