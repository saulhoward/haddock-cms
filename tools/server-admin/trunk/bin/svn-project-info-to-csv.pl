#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

svn-project-info-to-csv.pl

=head1 SYNOPSIS

    $ ./svn-project-info-to-csv.pl DIR

=head1 DESCRIPTION

A little script to find info from an SVN project and
print this data as CSV.

The directory given should contain an SVN project, e.g.

    DIR/trunk
    DIR/branches/foo
    DIR/branches/bar
    DIR/branches/baz
    DIR/tags/foo/0.0.1
    DIR/tags/foo/0.0.2

=head1 AUTHOR

RFI

=head1 COPYRIGHT

Clear Line Web Design, 2007-06-14

=head1 LICENCE

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

use Cwd;

scalar @ARGV == 1
    or die "Please give me a directory!\n";

my $project_dir = $ARGV[0];

(-d $project_dir)
    or die "$project_dir is not a directory!\n";

print "Looking in $project_dir\n";

my $csv_file_name = $project_dir;
$csv_file_name =~ s/[\W]+/_/g;
$csv_file_name .= '.csv';

# Open the CSV.
open CSV, ">$csv_file_name"
    or die "Unable to open $csv_file_name for writing!\n";

my @svn_working_dirs;

# Is there a trunk dir?

if (-d "$project_dir/trunk") {
    chdir "$project_dir/trunk";
    
    push @svn_working_dirs, getcwd;
}

# Are there any branches?

if (-d "$project_dir/branches") {
    chdir "$project_dir/branches";
    
    for (<*>) {
        if (-d $_) {
            push @svn_working_dirs, getcwd . "/$_";
        }
    }
}

# What about tags?
if (-d "$project_dir/tags") {
    chdir "$project_dir/tags";
    
    my @first_level = <*>;
    for (@first_level) {
        if (-d $_) {
            chdir "$project_dir/tags/$_";
            
            my @second_level = <*>;
            for (@second_level) {
                if (-d $_) {
                    push @svn_working_dirs, getcwd . "/$_";
                }
            }
        }
    }
}

# Find info about these directories.
my @info_for_dirs;
my %columns;
for (@svn_working_dirs) {
    #print "$_\n";
    chdir $_;
    
    my $cmd = 'svn info "' . getcwd . '"';
    
    my $svn_info = `$cmd`;
    
    my %info_for_dir;
    
    for (split /\n/, $svn_info) {
        chomp;
        
        if (/(.+):\s+(.+)/) {
            $columns{$1} = 1 unless $columns{$1};
            
            $info_for_dir{$1} = $2;
        }
    }
    
    push @info_for_dirs, \%info_for_dir;
}

# Write a header for the CSV.
foreach (sort keys %columns) {
    print CSV "\"$_\",";
}
print CSV "\n\n";

# Write out the data.
for (@info_for_dirs) {
    my %info_for_dir = %$_;
    
    foreach (sort keys %columns) {
        print CSV '"';
        
        print CSV $info_for_dir{$_};
        
        print CSV '",';
    }
    
    print CSV "\n";
}

close CSV;
