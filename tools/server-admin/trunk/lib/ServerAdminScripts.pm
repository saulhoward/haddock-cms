package ServerAdminScripts;

use strict;
use warnings;

use DBI;
use File::Basename;

require Exporter;

our @ISA = qw(Exporter);
our @EXPORT_OK = qw(print_and_do_cmd $debug);

our $debug;

sub print_and_do_cmd
{
    my $cmd = shift;
    
    print STDERR "$cmd\n" if $debug;
    system $cmd unless $debug;
}

sub get_haddock_dbh
{
    my $directory = shift;
    
    # Read the PHP password file.
    my $php_passwords_file = "$directory/passwords/passwords.inc.php";
    my %db_data;
    if (-f $php_passwords_file) {
        open PWF, "<$php_passwords_file"
            or die "Unable to open $php_passwords_file! $!\n";
        
        for (<PWF>) {
            chomp;
            
            if (/define\((.+), '(.+)'\);/) {
                $db_data{$1} = $2;
            }
        }
        
        close PWF;
    } else {
        die "$php_passwords_file does not exist!\n";
    }
    
    if ($debug) {
        print STDERR "The database access data:\n";
        
        for (sort keys %db_data) {
            print STDERR "$_: $db_data{$_}\n";
        }
    }
    
    # Connect to the database.
    my $dsn = "DBI:mysql:database=$db_data{DB_DATABASE};host=$db_data{DB_HOST};";
    
    my $dbh = DBI->connect($dsn, $db_data{DB_USERNAME}, $db_data{DB_PASSWORD});
    
    return $dbh;
}

sub get_tables_at_dbh
{
    my $dbh = shift;
    
    # Find the list of tables.
    my @tables;
    my $sth = $dbh->prepare('SHOW TABLES');
    
    $sth->execute;
    
    while (my @row = $sth->fetchrow_array) {
        my $table = shift @row;
        
        push @tables, $table;
    }
    
    return @tables;
}

sub get_choice_from_user
{
    my $name = shift;
    
    while (1) {
        print "Which $name?\n";
        
        for (0 .. (scalar(@_) - 1)) {
            print $_, ') ', $_[$_], "\n";
        }
        
        print "Press 'b' to go back.\n";
        
        my $choice = <STDIN>;
        chomp $choice;
        
        return undef if $choice =~ /b/i;
        
        if ($choice eq '' or $choice !~ /\d+/) {
            print STDERR "Please enter a number.\n";
            next;
        }
        
        if (($choice > scalar(@_)) or ($choice < 0)) {
            print STDERR "$choice is out of range!\n";
            next;
        }
        
        return $_[$choice];
    }
}

sub get_modules_for_haddock_project
{
    my $directory = shift;
    
    my %modules;

    for my $tl (qw(haddock plug-ins)) {
        for (<$directory/$tl/*>) {
            if (-d $_) {
                push @{$modules{$tl}}, basename($_);
            }
        }
    }
    
    return %modules;
}

sub get_fields_for_table
{
    my $dbh = shift;
    my $table = shift;
    
    my %field_hash_refs;
    
    my $sth = $dbh->prepare("DESCRIBE $table");
    
    $sth->execute;
    
    while (my $field_hash_ref = $sth->fetchrow_hashref) {
        $field_hash_refs{$field_hash_ref->{Field}} = $field_hash_ref;
    }
    
    return %field_hash_refs;
}

sub get_sql_dirs
{
    my $haddock_dir = shift;
    
    my @sql_dirs;

    if (-d "$haddock_dir/project-specific/sql") {
        push @sql_dirs, "$haddock_dir/project-specific/sql";
    }
    
    for (qw(haddock plug-ins)) {
        for (<$haddock_dir/$_/*>) {
            if (-d "$_/sql") {
                push @sql_dirs, "$_/sql";
            }
        }
    }
    
    return @sql_dirs;
}

sub get_haddock_table_dirs
{
    my %haddock_table_dirs;
    
    foreach my $sql_dir (@_) {
        foreach my $table_dir (<$sql_dir/*>) {
            if (-d $table_dir) {
                $haddock_table_dirs{basename($table_dir)} = $table_dir;
            }
        }
    }
    
    return %haddock_table_dirs;
}

1;
