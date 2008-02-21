#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

find-all-svn-working-dirs.pl

=head1 SYNOPSIS

    $ ./find-all-working-dirs.pl DIR0 [DIR1 ...]

=head1 DESCRIPTION

A little script that finds all the SVN working directories
beneath a given list of directories.

=head1 AUTHOR

RFI

=head1 COPYRIGHT

Clear Line Web Design, 2007-06-03

=cut

use File::Find;

die "Please give me at least one directory!\n" unless @ARGV;

my %dirs;

finddepth(\&find_dirs, @ARGV);

sub find_dirs
{
    if (-d $File::Find::name) {
        my $dir = $File::Find::name;
        
        $dir =~ s{\\}{/}g;
        
        $dirs{$dir} = 1;
    }
}

# Prune.

#@svn_dirs = sort @svn_dirs;
#
#my %svn_dirs;
#
#for (@svn_dirs) {
#    $svn_dirs{$_} = 1;
#}
#
#my @dirs_to_prune;
#push @dirs_to_prune, $svn_dirs[0];
#
#while (my $dir_to_prune = shift @dirs_to_prune) {
#    for (keys %svn_dirs) {
#        if ($svn_dirs{$_}) {
#            
#        }
#    }
#}

for my $tld (sort keys %dirs) {
    if ($dirs{$tld}) {
        if (-d "$tld/.svn") {
            $dirs{$tld} = 'svn';
            for my $pos_sub_d (sort keys %dirs) {
                if ($dirs{$pos_sub_d}) {
                    if ($pos_sub_d =~ /^$tld.+/) {
                        $dirs{$pos_sub_d} = 0;
                    }
                }
            }
        }
    }
}

for (sort keys %dirs) {
    if ($dirs{$_} eq 'svn') {
        print "$_\n";
    }
}
