#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

sync-database-to-files.pl

=head1 SYNOPSIS

    $ ./sync-database-to-files.pl

=head1 DESCRIPTION

Inspects the database and saves meta data about it.

=head2 Options

=over 12

=item C<-d|--directory>

The directory that contains the haddock project.

=item C<-h|--help>

Print this message and exit.

=item C<--debug>

Run in debug mode.

=back

=head1 COPYRIGHT

Clear Line Web Design, 2007-07-04

=cut

use Getopt::Long;
use Pod::Usage;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

if ($^O eq 'MSWin32') {
    require Win32;
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

$directory =~ s{/$}{};

if ($^O eq 'MSWin32') {
    $directory = Win32::GetShortPathName($directory);
}

(-d $directory)
    or die "$directory is not a directory!\n";

# Get the list of tables.
my $haddock_dbh = ServerAdminScripts::get_haddock_dbh($directory);

my @tables = ServerAdminScripts::get_tables_at_dbh($haddock_dbh);

if ($debug) {
    print STDERR "Tables.\n";
    
    for (@tables) {
        print STDERR "$_\n";
    }
}

# Find which tables already have data saved.
# What happens if there is a conflict?
# i.e. The data for a table gets saved in two modules?
my %modules = ServerAdminScripts::get_modules_for_haddock_project($directory);

#my %fields_files;
#
#foreach my $tl (sort keys %modules) {
#    foreach my $module (sort @{ $modules{$tl} }) {
#        my $sql_dir = "$directory/$tl/$module/sql";
#        
#        if (-d $sql_dir) {
#            foreach my $table_dir (<$sql_dir/*>) {
#                if (-d $table_dir) {
#                    my $fields_file = "$table_dir/fields.csv";
#                    
#                    if (-f $fields_file) {
#                        $fields_files{basename($table_dir)} = $fields_file;
#                    }
#                }
#            }
#        }
#    }
#}
#
#if ($debug) {
#    print STDERR "Fields files.\n";
#    
#    for (sort keys %fields_files) {
#        print STDERR "$_: ", $fields_files{$_}, "\n";
#    }
#}

#my $table = ServerAdminScripts::get_choice_from_user('table', @tables);

# Which tables (which don't already have files) have names that
# can be parsed?
my %parsable_table_names;
TABLE: foreach my $table (@tables) {
    #if ($table =~ /^(hc|hpi|ps)_([a-z_]+)$/) {
    if ($table =~ /^(hc|hpi|ps)_([a-z_0-9]+)$/) {
        my $current_table_tl = $1;
        
        my $second_half_of_current_table_name = $2;
        
        if ($current_table_tl eq 'ps') {
            $parsable_table_names{$table} =
                {
                    tl => $current_table_tl
                };
                
            next TABLE;
        } else {
            foreach my $tl (sort keys %modules) {
                foreach my $module (sort @{ $modules{$tl} }) {
                    my $module_name_with_underscores = $module;
                    
                    $module_name_with_underscores =~ s/-/_/g;
                    
                    #if ($second_half_of_current_table_name =~ /^$module_name_with_underscores\_[a-z_]+$/) {
                    if ($second_half_of_current_table_name =~ /^$module_name_with_underscores\_[a-z_0-9]+$/) {
                        $parsable_table_names{$table} =
                            {
                                tl => $current_table_tl,
                                module => $module
                            };
                            
                        next TABLE;
                    }
                }
            }
        }
    } 
}

print "The following tables have parsable names:\n";

foreach my $table (sort keys %parsable_table_names) {
    print "Table: $table\n";
    
    print "Top level: $parsable_table_names{$table}->{tl}\n";
    
    if (defined $parsable_table_names{$table}->{module}) {
        print "Module: $parsable_table_names{$table}->{module}\n";
    }
    
    print "\n";
}

# Save the meta-data for the tables with parsable names.
foreach my $table (sort keys %parsable_table_names) {
    my %field_hash_refs
        = ServerAdminScripts::get_fields_for_table($haddock_dbh, $table);
    
    my $csv_str = field_hash_refs_to_csv_str(\%field_hash_refs);
    
    my $csv_directory = "$directory/";
    
    if ($parsable_table_names{$table}->{tl} eq 'ps') {
        $csv_directory .= 'project-specific/';
    } else {
        if ($parsable_table_names{$table}->{tl} eq 'hc') {
            $csv_directory .= 'haddock/';
        } elsif ($parsable_table_names{$table}->{tl} eq 'hpi') {
            $csv_directory .= 'plug-ins/';
        }
        
        $csv_directory .= "$parsable_table_names{$table}->{module}/";
    }
    
    $csv_directory .= "sql/$table/";
    
    print_and_do_cmd("mkdir -p $csv_directory") unless -d $csv_directory;
    
    my $csv_file = "$csv_directory/fields.csv";
    
    if ($debug) {
        print STDERR "Saving metadata in $csv_file\n";
        
        print STDERR $csv_str;
    } else {
        open CSV, ">$csv_file"
            or die "Unable to open $csv_file: $!\n";
        
        print CSV $csv_str;
        
        close CSV;
    }
}

# Find the tables that don't have parsable names.
my @unparsable_table_names;
foreach my $table (@tables) {
    unless (defined $parsable_table_names{$table}) {
        push @unparsable_table_names, $table;
    }
}

print "The following tables have unparsable names: \n";
foreach my $table (@unparsable_table_names) {
    print "$table\n";
}

######
# Subs

sub field_hash_refs_to_csv_str
{
    my %field_hash_refs = %{$_[0]};
    
    my $csv_str;
    foreach (sort keys %field_hash_refs) {
        my %field_data = %{$field_hash_refs{$_}};
        
        $csv_str .= '"' . (defined($field_data{Field}) ? $field_data{Field} : '') . '",';
        $csv_str .= '"' . (defined($field_data{Type}) ? $field_data{Type} : '') . '",';
        $csv_str .= '"' . (defined($field_data{Null}) ? $field_data{Null} : '') . '",';
        $csv_str .= '"' . (defined($field_data{Key}) ? $field_data{Key} : '') . '",';
        $csv_str .= '"' . (defined($field_data{Default}) ? $field_data{Default} : '') . '",';
        $csv_str .= '"' . (defined($field_data{Extra}) ? $field_data{Extra} : '') . "\"\n";
    }
    
    return $csv_str;
}
