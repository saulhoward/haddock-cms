#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

compare-a-file-in-branches.pl

=head1 SYNOPSIS

    $ ./compare-a-file-in-branches.pl -d DIR -f FILE

=head1 DESCRIPTION

Looks at different versions of a file in different branches of
an SVN project and groups them by their MD5 checksum.

Also looks at the file in the trunk.

=head2 Options

=over 12

=item C<-d|--directory>

The directory containing the project.

=item C<-f|--file>

The file that we want to look at.

This should be relevant to the branch root.

=item C<-h|--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-10

=head1 LICENCE

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see L<http://www.gnu.org/licenses/>.

=cut

use Getopt::Long;
use Pod::Usage;
use File::stat;
use Digest::MD5 qw(md5_hex);

# Get the options from the user.
my ($directory, $file, $help, $debug);

GetOptions(
    'd|directory=s' => \$directory,
    'f|file=s' => \$file,
    'h|help' => \$help,
    'debug' => \$debug
);

if (defined($help)) {
    pod2usage(-verbose => 2);
}

if ($debug) {
    print STDERR "Running in debug mode.\n";
}

# Check the user's input.

defined($directory)
    or die "The directory must be set with -d!\n";

$directory =~ s{/$}{};

(-d $directory)
    or die "$directory is not a directory!\n";

defined($file)
    or die "The file must be set with -f!\n";

# Move to the branches directory.
chdir $directory;

# Find the different branches.
my @branches;
for (<branches/*>) {
    if (-d $_) {
        push @branches, $_;
    }
}

if ($debug) {
    print STDERR scalar(@branches), " branches found.\n";
    
    for (@branches) {
        print STDERR "$_\n";
    }
}

# Look at the files.
my @files;
foreach my $branch (@branches) {
    my $file_name = "$branch/$file";
    
    if (-f $file_name) {
        my %file_data;
        
        $file_data{branch} = $branch;
        
        $file_data{name} = $file_name;
        
        my $stat = stat $file_name;
        
        $file_data{size} = $stat->size;
        $file_data{mtime} = localtime $stat->mtime;
        $file_data{ctime} = localtime $stat->ctime;
        $file_data{atime} = localtime $stat->atime;
        
        # Get the MD5 sum.
        my $file_contents;
        open FILE, "<$file_name"
            or die "Unable to open $file_name for reading! $!\n";
        
        for (<FILE>) {
            $file_contents .= $_;
        }
        
        close FILE;
        
        $file_data{md5} = md5_hex($file_contents);
        
        push @files, \%file_data;
    }
}

# Add the file in the trunk.
{
    my $file_name = "trunk/$file";
    
    my %file_data;
        
    $file_data{branch} = 'trunk';
    
    $file_data{name} = $file_name;
    
    my $stat = stat $file_name;
    
    $file_data{size} = $stat->size;
    $file_data{mtime} = localtime $stat->mtime;
    $file_data{ctime} = localtime $stat->ctime;
    $file_data{atime} = localtime $stat->atime;
    
    # Get the MD5 sum.
    my $file_contents;
    open FILE, "<$file_name"
        or die "Unable to open $file_name for reading! $!\n";
    
    for (<FILE>) {
        $file_contents .= $_;
    }
    
    close FILE;
    
    $file_data{md5} = md5_hex($file_contents);
    
    push @files, \%file_data;
}

if ($debug) {
    print STDERR "The file data.\n";
    
    for (@files) {
        print STDERR '-' x 40, "\n";
        
        my %data = %$_;
        
        for (sort keys %data) {
            print "$_: $data{$_}\n";
        }
        
        print STDERR '-' x 40, "\n";
    }
}

# Group the file by md5.
my %files_grouped_by_md5;
foreach my $file (@files) {
    my %file_data = %$file;
    
    push @{$files_grouped_by_md5{$file_data{md5}}}, $file;
}

# Print out the data found.
print "The file data grouped by MD5.\n";

for (sort keys %files_grouped_by_md5) {
    print '-' x 40, "\n";
    
    print "MD5: $_.\n";
    
    my @files = @{$files_grouped_by_md5{$_}};
    
    print scalar(@files), " files with this checksum.\n";
    
    for (@files) {
        print '-' x 30, "\n";
        
        my %file_data = %{$_};
        
        for (sort keys %file_data) {
            print "$_: $file_data{$_}\n";
        }
        
        print '-' x 30, "\n";
    }
    
    print '-' x 40, "\n";
}
