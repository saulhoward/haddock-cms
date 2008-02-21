#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

assemble-dbcnf-from-csv-files.pl

=head1 SYNOPSIS

    $ ./assemble-dbcnf-from-csv-files.pl

=head1 DESCRIPTION

Finds the CSV files that specify which classes are associated with
which database entities and assembles a file that is used by the
haddock code to know which class to use with which database entity.

=head2 Options

=over 12

=item C<-d|--directory>

The directory that contains the haddock project.

Default: C<.>

=item <-x|--xml-file>

Output a XML file instead of an .INC file.

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
#use XML::Simple qw(XMLout);
use utf8;
use POSIX qw(strftime);

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

if ($^O eq 'MSWin32') {
  require Win32;
}

# Get the options from the user.
my ($directory, $xml_file_out, $help, $debug);

GetOptions(
    'd|directory=s' => \$directory,
    'x|xml-file' => \$xml_file_out,
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
    #or die "The directory must be set with -d!\n";
    or $directory = '.';

$directory =~ s{/$}{};

if ($^O eq 'MSWin32') {
    $directory = Win32::GetShortPathName($directory);
}

(-d $directory)
    or die "$directory is not a directory!\n";

# Find the SQL directories.
my @sql_dirs = ServerAdminScripts::get_sql_dirs($directory);

my %table_dirs = ServerAdminScripts::get_haddock_table_dirs(@sql_dirs);

my %database_class_data;
foreach my $table (sort keys %table_dirs) {
    if ($debug) {
        print STDERR "Table: $table\n";
    }
    
    my %table_class_data;
    
    for my $element (qw(table row)) {
        my %element_hash;
        for my $toc (qw(class renderer)) {
            my $data_file = "$table_dirs{$table}/$element-$toc.csv";
            if (-f $data_file) {
                open TDF, "<$data_file"
                    or die "Unable to open $data_file for reading: $!\n";
                
                my %class_hash;
                for (<TDF>) {
                    if (/"(.+)","(.+)"/) {
                        
                        print STDERR "Class name: $1\n" if $debug;
                        print STDERR "Class file: $2\n" if $debug;
                        
                        $class_hash{class_name} = $1;
                        $class_hash{class_file} = $2;
                    }
                }
                
                close TDF;
                
                print STDERR "Class hash: ", %class_hash, "\n" if $debug;
                
                if ($debug) {
                    print STDERR "Class hash values:\n";
                    
                    for (sort keys %class_hash) {
                        print STDERR "$_: $class_hash{$_}\n";
                    }
                }
                
                my $class_hash_ref = \%class_hash;
                
                print STDERR "Class hash ref: $class_hash_ref\n" if $debug;
                
                $element_hash{$toc} = $class_hash_ref;
            }
        }
        
        $table_class_data{$element} = \%element_hash;
    }
    
    my %fields_hash;
    for my $field_file (<$table_dirs{$table}/field-*.csv>) {
        if ($field_file =~ /field-(.+)-(class|renderer).csv/) {
            my $field_name = $1;
            my $toc = $2;
            
            open TDF, "<$field_file"
                or die "Unable to open $field_file for reading: $!\n";
            
            for (<TDF>) {
                if (/"(.+)","(.+)"/) {
                    $fields_hash{$field_name}
                        ->{$toc} =
                            {
                                class_name => $1,
                                class_file => $2
                            };
                }
            }
            
            close TDF;
        }
    }
    
    $table_class_data{fields} = \%fields_hash;
    
    $database_class_data{$table} = \%table_class_data;
}

my $date = strftime "%Y-%m-%d", gmtime;

my $xml;

$xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
$xml .= "<database>\n";

my $inc = <<INC;
<?php
/**
 * The database class names.
 *
 * \@copyright Clear Line Web Design, $date
 */

\$_SESSION['database-class-names'] = array();
INC

print STDERR "The database class data:\n" if $debug;

for my $table (sort keys %database_class_data) {
    $xml .= "<table id=\"$table\">\n";
    
    $inc .= "\$_SESSION['database-class-names']['$table'] = array();\n";
    
    print STDERR '-' x 40, "\n" if $debug;
    
    print STDERR "Table: $table\n" if $debug;
    
    my %table_class_data = %{$database_class_data{$table}};
    
    for my $element (qw(table row)) {
        my %element_hash = %{$table_class_data{$element}};
        for my $toc (qw(class renderer)) {
            my $class_hash_ref = $element_hash{$toc};
            
            print STDERR "Class hash ref: $class_hash_ref\n" if $debug;
            
            my %class_hash = %$class_hash_ref;
            
            print STDERR "Class hash: ", %class_hash, "\n" if $debug;
            
            if ($debug) {
                print STDERR "Class hash values: \n";
                
                for (sort keys %class_hash) {
                    print STDERR "$_: $class_hash{$_}\n";
                }
            }
            
            print STDERR "Element: $element\n" if $debug;
            print STDERR "TOC: $toc\n" if $debug;
            
            print STDERR "Class: $class_hash{class_name}\n" if $debug;
            print STDERR "File: $class_hash{class_file}\n" if $debug;
            
            print STDERR '-' x 20, "\n" if $debug;
            
            $xml .= "<entity\n";
            $xml .= "id=\"$element\_$toc\"\n";
            #$xml .= "toc=\"$toc\"\n";
            $xml .= "class_name=\"$class_hash{class_name}\"\n";
            $xml .= "class_file=\"$class_hash{class_file}\"\n";
            $xml .= "/>\n";
            
            
            $inc .= "\$_SESSION['database-class-names']['$table']['$element\_$toc']['class_name'] = \"$class_hash{class_name}\";\n";
            $inc .= "\$_SESSION['database-class-names']['$table']['$element\_$toc']['class_file'] = \"$class_hash{class_file}\";\n";
        }
        print STDERR '-' x 30, "\n" if $debug;
    }
    
    $xml .= "<fields>\n";
    my %fields_hash = %{$table_class_data{fields}};
    foreach my $field (sort keys %fields_hash) {
        $xml .= "<field\n";
        $xml .= "id=\"$field\"\n";
        $xml .= ">\n";
        
        print STDERR "Field: $field\n" if $debug;
        
        my %field_hash = %{$fields_hash{$field}};
        
        print STDERR "Field hash: ", %field_hash, "\n" if $debug;
        
        foreach my $toc (sort keys %field_hash) {
            $xml .= "<entity\n";
            
            $xml .= "toc=\"$toc\"\n";
            
            print STDERR "TOC: $toc\n" if $debug;
            
            my %entity_hash = %{$field_hash{$toc}};
            
            if ($debug) {
                print STDERR "Entity hash values:\n";
                
                for (sort keys %entity_hash) {
                    print STDERR "$_: $entity_hash{$_}\n";
                }
            }
            
            $xml .= "class_name=\"$entity_hash{class_name}\"\n";
            $xml .= "class_file=\"$entity_hash{class_file}\"\n";
            
            $xml .= "/>\n";

            $inc .= "\$_SESSION['database-class-names']['$table']['fields']['$field']['$toc']['class_name'] = \"$entity_hash{class_name}\";\n";
            $inc .= "\$_SESSION['database-class-names']['$table']['fields']['$field']['$toc']['class_file'] = \"$entity_hash{class_file}\";\n";
        }
        
        $xml .= "</field>\n";
    }
    $xml .= "</fields>\n";
    
    $xml .= "</table>\n";
    print STDERR '-' x 40, "\n" if $debug;
}
$xml .= "</database>\n";

$inc .= <<INC;
?>
INC

#my $xml = XMLout
#    (
#        \%database_class_data,
#        RootName => 'database'
#    );

my $ps_sql_dir = "$directory/project-specific/sql";

unless (-d $ps_sql_dir) {
    print_and_do_cmd("mkdir -p $ps_sql_dir");
}

if ($xml_file_out) {
    my $database_class_names_xml_file = "$ps_sql_dir/database-class-names.xml";
    
    if ($debug) {
        print STDERR "Saving XML in $database_class_names_xml_file\n";
        print STDERR $xml;
    } else {
        open XML, ">$database_class_names_xml_file"
            or die "Unable to open $database_class_names_xml_file for writing: $!\n";
        
        print XML $xml;
        
        close XML;
    }
} else {
    my $database_class_names_inc_file = "$ps_sql_dir/database-class-names.inc.php";
    
    if ($debug) {
        print STDERR "Saving .INC in $database_class_names_inc_file\n";
        print STDERR $inc;
    } else {
        open INC, ">$database_class_names_inc_file"
            or die "Unable to open $database_class_names_inc_file for writing: $!\n";
        
        print INC $inc;
        
        close INC;
    }
}
