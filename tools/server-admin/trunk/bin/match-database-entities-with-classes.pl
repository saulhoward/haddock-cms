#!/usr/bin/perl

use strict;
use warnings;

=head1 NAME

match-database-entities-with-classes.pl

=head1 SYNOPSIS

    $ ./match-database-entities-with-classes.pl

=head1 DESCRIPTION

Finds the CSV files that specify the structure of the database
and allows you to specify which class should be used to represent
that entity.

=head2 Options

=over 12

=item C<-d|--directory>

The directory that contains the haddock project.

Default: C<.>

=item C<-i|--interactive>

Run interactively.

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
use File::Basename;

use FindBin qw($Bin);
use lib "$Bin/../lib";

use ServerAdminScripts qw(print_and_do_cmd);

if ($^O eq 'MSWin32') {
    require Win32;
}

# Get the options from the user.
my ($directory, $interactive, $help, $debug);

GetOptions(
    'd|directory=s' => \$directory,
    'i|interactive' => \$interactive,
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

# Find the fields files.

my @sql_dirs;

if (-d "$directory/project-specific/sql") {
    push @sql_dirs, "$directory/project-specific/sql";
}

for (qw(haddock plug-ins)) {
    for (<$directory/$_/*>) {
        print STDERR "Looking for an SQL dir in $_.\n" if $debug;
        
        if (-d "$_/sql") {
            push @sql_dirs, "$_/sql";
        }
    }
}

if ($debug) {
    print STDERR 'Found ', scalar(@sql_dirs), " SQL dirs.\n";
    
    for (@sql_dirs) {
        print STDERR "$_\n";
    }
}

my %fields_files;

foreach my $sql_dir (@sql_dirs) {
    foreach my $table_dir (<$sql_dir/*>) {
        if (-d $table_dir) {
            my $table = basename($table_dir);
            
            my $fields_file = "$table_dir/fields.csv";
            
            if ($debug) {
                print STDERR "Opening $fields_file\n";
            }
            
            if (-f $fields_file) {
                my %fields_file_data;
                
                $fields_file_data{filename} = $fields_file;
                $fields_file_data{directory} = dirname($fields_file);
                
                open FF, "<$fields_file"
                    or die "Unable to open $fields_file: $!\n";
                
                my @lines_of_field_data;
                foreach my $field_line (<FF>) {
                    if ($debug) {
                        print STDERR $field_line;
                    }
                    
                    my %field_line_data;
                    
                    chomp $field_line;
                    $field_line =~ s/^"//;
                    $field_line =~ s/"$//;
                    
                    my @comma_separated_values = split /","/, $field_line;
                    
                    if ($debug) {
                        print STDERR "CSVs: \n";
                        
                        print STDERR "$_: $comma_separated_values[$_]\n" for (0 .. $#comma_separated_values);
                    }
                    
                    my $i = 0;
                    for (qw(Field Type Null Key Default Extra)) {
                        if (defined $comma_separated_values[$i]) {
                            $field_line_data{$_} = $comma_separated_values[$i];
                        } else {
                            $field_line_data{$_} = '';
                        }
                        
                        $i++;
                    }
                    
                    if ($debug) {
                        print STDERR "Hash values:\n";
                        
                        print STDERR "$_: $field_line_data{$_}\n" for (sort keys %field_line_data);
                        
                        print STDERR "\n";
                    }
                    
                    push @lines_of_field_data, \%field_line_data;
                }
                
                close FF;
                
                if ($debug) {
                    print STDERR 'Lines of data: ', scalar @lines_of_field_data, "\n";
                }
                
                $fields_file_data{fields} = \@lines_of_field_data;
                
                $fields_files{$table} = \%fields_file_data;
            }
        }
    }
}

if ($debug) {
    print STDERR "Found ", scalar(keys %fields_files), " table meta data files.\n";
    
    for (sort keys %fields_files) {
        print STDERR "Table: $_\n";
        
        print STDERR "File: $fields_files{$_}->{filename}\n";
        print STDERR "Directory: $fields_files{$_}->{directory}\n";
        
        print STDERR "\n";
    }
}

if ($interactive) {
    TABLE: while (1) {
        # Which table does the user want to work with?
        my $table = ServerAdminScripts::get_choice_from_user('table', sort keys %fields_files);
        
        if (defined $table) {
            print "Working with $table.\n";
            
            my %fields_file_data = %{$fields_files{$table}};
            
            my $save_directory = $fields_file_data{directory};
            print "Saving the data in $save_directory.\n";
            
            
            ELEMENT: {
                my $element = ServerAdminScripts::get_choice_from_user('element', qw(table row field));
                
                if (defined $element) {
                    print "Working with the $element\n";
                } else {
                    next TABLE;
                }
                
                # Which field, if necessary?
                my $field = undef;
                if ($element eq 'field') {
                    my @fields;
                    print $fields_file_data{fields}, "\n";
                    
                    for (@{ $fields_file_data{fields} }) {
                        #print "$_\n";
                        push @fields, $_->{Field};
                    }
                    
                    if ($debug) {
                        print STDERR "Fields: \n";
                        
                        for (@fields) {
                            print STDERR "$_\n";
                        }
                    }
                    
                    $field = ServerAdminScripts::get_choice_from_user('field', @fields);
                    
                    if (defined $field) {
                        print "Working with the $field field.\n";
                    } else {
                        next ELEMENT;
                    }
                }
                
                # Class or renderer?
                my $type_of_class = ServerAdminScripts::get_choice_from_user('type of class', qw(class renderer));
                
                if (defined $type_of_class) {
                    print "Setting the $type_of_class\n";
                } else {
                    next ELEMENT;
                }
                
                # Find the subclasses of this type of element.
                my $element_class;
                if ($element eq 'table') {
                    $element_class = 'Database_Table';
                } elsif ($element eq 'row') {
                    $element_class = 'Database_Row';
                } elsif ($element eq 'field') {
                    $element_class = 'Database_Field';
                }
                
                if ($type_of_class eq 'renderer') {
                    $element_class .= 'Renderer';
                }
                
                my $cmd = "php $directory/haddock/cli-scripts/bin/bin-runner.php --section=haddock --module=haddock-project-organisation --script=list-classes --parent-class=$element_class";
                
                if ($debug) {
                    print "$cmd\n";
                }
                
                my $subclasses_csv = `$cmd`;
                my %subclasses;
                for (split /\n/, $subclasses_csv) {
                    if (/"(.+)","(.+)"/) {
                        $subclasses{$1} = $2;
                    }
                }
                
                if ($debug) {
                    for (sort keys %subclasses) {
                        print "$_: ", $subclasses{$_}, "\n";
                    }
                }
                
                my $subclass = ServerAdminScripts::get_choice_from_user('subclass', sort keys %subclasses);
                
                if (defined $subclass) {
                    print "Using $subclass\n";
                } else {
                    next ELEMENT;
                }
                
                # Save the data.
                my $data_file = "$save_directory/$element-";
                
                if ($element eq 'field') {
                    $data_file .= "$field-";
                }
                
                $data_file .= "$type_of_class.csv";
                
                my $class_string = "\"$subclass\",\"$subclasses{$subclass}\"\n";
                
                if ($debug) {
                    print "Writing to $data_file\n";
                    print $class_string;
                } else {
                    open CSV, ">$data_file"
                        or die "Unable to open $data_file for writing: $!\n";
                    
                    print CSV $class_string;
                    
                    close CSV;
                }
            }
        } else {
            last TABLE;
        }
    }
} else {
    foreach my $table (sort keys %fields_files) {
        my %fields_file_data = %{$fields_files{$table}};
            
        my $save_directory = $fields_file_data{directory};
        
        for my $element (qw(table row)) {
            for my $toc (qw(class renderer)) {
                my $file = "$save_directory/$element-$toc.csv";
                
                if (-f $file) {
                    print STDERR "Skipping $file.\n" if $debug;
                } else {
                    print STDERR "Saving data in $file.\n" if $debug;
                    
                    my $php_class = 'Database_';
                    
                    my $php_class_file = '/plug-ins/database/classes/';
                    if ($toc eq 'class') {
                        $php_class_file .= 'elements';
                    } elsif ($toc eq 'renderer') {
                        $php_class_file .= 'renderers';
                    }
                    $php_class_file .= '/Database_';
                    
                    if ($element eq 'table') {
                        $php_class .= 'Table';
                        $php_class_file .= 'Table';
                    } elsif ($element eq 'row') {
                        $php_class .= 'Row';
                        $php_class_file .= 'Row';
                    }
                    
                    if ($toc eq 'renderer') {
                        $php_class .= 'Renderer';
                        $php_class_file .= 'Renderer';
                    }
                    
                    $php_class_file .= '.inc.php';
                    
                    my $csv_str = "\"$php_class\",\"$php_class_file\"\n";
                    
                    if ($debug) {
                        print STDERR $csv_str;
                    } else {
                        open CSV, ">$file"
                            or die "Unable to open $file for writing! $!\n";
                        
                        print CSV $csv_str;
                        
                        close CSV;
                    }
                }
            }
        }
        
        for my $field_data_ref (@{ $fields_file_data{fields} }) {
            for my $toc (qw(class renderer)) {
                my $file = "$save_directory/field-$field_data_ref->{Field}-$toc.csv";
                
                if (-f $file) {
                    print STDERR "Skipping $file.\n" if $debug;
                } else {
                    print STDERR "Saving data in $file.\n" if $debug;
                    
                    my $php_class = 'Database_';
                    my $php_class_file = '/plug-ins/database/classes/';
                    
                    if ($debug) {
                        print STDERR "Type: $field_data_ref->{Type}\n"; #
                    }
                    
                    if ($toc eq 'class') {
                        if ($field_data_ref->{Type} =~ /varchar/) {
                            $php_class .= 'VarChar';
                            $php_class_file .= 'elements/field-subclasses/Database_VarChar';
                        } elsif ($field_data_ref->{Type} =~ /text/) {
                            $php_class .= 'Text';
                            $php_class_file .= 'elements/field-subclasses/Database_Text';
                        } elsif ($field_data_ref->{Type} =~ /blob/) {
                            $php_class .= 'Blob';
                            $php_class_file .= 'elements/field-subclasses/Database_Blob';
                        } elsif ($field_data_ref->{Type} =~ /int/) {
                            $php_class .= 'Int';
                            $php_class_file .= 'elements/field-subclasses/Database_Int';
                        } elsif ($field_data_ref->{Type} =~ /enum/) {
                            $php_class .= 'Enum';
                            $php_class_file .= 'elements/field-subclasses/Database_Enum';
                        } elsif ($field_data_ref->{Type} =~ /datetime/) {
                            $php_class .= 'DateTime';
                            $php_class_file .= 'elements/field-subclasses/Database_DateTime';
                        } else {
                            $php_class_file .= 'elements/Database_';
                        }
                        
                        $php_class .= 'Field';
                        $php_class_file .= 'Field';
                    } elsif ($toc eq 'renderer') {
                        if ($field_data_ref->{Type} =~ /varchar/) {
                            $php_class .= 'ShortText';
                            $php_class_file .= 'renderers/field-renderers/Database_ShortText';
                        } elsif ($field_data_ref->{Type} =~ /text/) {
                            $php_class .= 'LongText';
                            $php_class_file .= 'renderers/field-renderers/Database_LongText';
                        } elsif ($field_data_ref->{Type} =~ /blob/) {
                            $php_class .= 'Blob';
                            $php_class_file .= 'renderers/field-renderers/Database_Blob';
                        } elsif ($field_data_ref->{Type} =~ /int/) {
                            $php_class .= 'ShortText';
                            $php_class_file .= 'renderers/field-renderers/Database_ShortText';
                        } elsif ($field_data_ref->{Type} =~ /enum/) {
                            $php_class .= 'Choice';
                            $php_class_file .= 'renderers/field-renderers/Database_Choice';
                        } elsif ($field_data_ref->{Type} =~ /datetime/) {
                            $php_class .= 'Time';
                            $php_class_file .= 'renderers/field-renderers/Database_Time';
                        } else {
                            $php_class_file .= 'renderers/Database_';
                        }
                        
                        $php_class .= 'FieldRenderer';
                        $php_class_file .= 'FieldRenderer';
                    }
                    
                    $php_class_file .= '.inc.php';
                    
                    my $csv_str = "\"$php_class\",\"$php_class_file\"\n";
                    
                    if ($debug) {
                        print STDERR $csv_str;
                    } else {
                        open CSV, ">$file"
                            or die "Unable to open $file for writing! $!\n";
                        
                        print CSV $csv_str;
                        
                        close CSV;
                    }
                }
            }
        }
    }
}
