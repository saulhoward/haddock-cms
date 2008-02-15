#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

print-revisions-of-working-dirs.pl

=head1 SYNOPSIS

    $ ./print-revisions-of-working-dirs.pl TXT

=head1 DESCRIPTION

A little script that finds all the SVN working directories
beneath a given list of directories.

=head1 AUTHOR

RFI

=head1 COPYRIGHT

Clear Line Web Design, 2007-06-03

=cut

use Cwd;

die "Please give me a directory!\n" unless scalar @ARGV == 1;

my $working_dirs_file = $ARGV[0];

#print "\$working_dirs_file: $working_dirs_file\n";

open(WDF, '<', $working_dirs_file)
    or die $!;

print "#path,url,repos_root,revision,last_changed_author,last_changed_revision,last_changed\n";

while (<WDF>) {
    chomp;
    
    chdir $_;
    
    my $info = `svn info .`;
    
    my ($url, $repos_root, $revision, $last_changed_author, $last_changed_revision, $last_changed);
    
    for (split /\n/, $info) {
        chomp;
        
        if (/^URL: (.+)/) {
            $url = $1;
        }
        
        if (/^Repository Root: (.+)/) {
            $repos_root = $1;
        }
        
        if (/^Revision: (\d+)/) {
            $revision = $1;
        }
        
        if (/^Last Changed Author: (.+)/) {
            $last_changed_author = $1;
        }
        
        if (/^Last Changed Rev: (\d+)/) {
            $last_changed_revision = $1;
        }
        
        if (/^Last Changed Date: (.+)/) {
            $last_changed = $1;
        }
    }
    
    print '"', getcwd, "\",\"$url\",\"$repos_root\",\"$revision\",\"$last_changed_author\",\"$last_changed_revision\",\"$last_changed\"\n";
}
