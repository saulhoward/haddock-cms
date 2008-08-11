<?php
/**
 * Logging_ServerLogsTable
 *
 * @copyright Clear Line Web Design, 2007-04-01
 */

require_once PROJECT_ROOT
    . '/haddock/database/classes/elements/'
    . 'Database_Table.inc.php';
    
class
    Logging_ServerLogsTable
extends
    Database_Table
{
    public function
        add_log_entry(
            $remote_addr,
            $session_id,
            $visited,
            $request_uri,
            $http_referer,
            $http_user_agent,
            $http_host
        )
    {
        $database = $this->get_database();
        
        $referer_domain_id = 0;
        
        if (
            preg_match(
                '{^(?:\w+://)?([^/]+)}',
                $http_referer,
                $matches
            )
        ) {
            $referer_domains_table = $database->get_table('hc_logging_referer_domains');
            
            $values = array();
            
            $values['domain'] = $matches[1];
            
            try {
                $referer_domain_id = $referer_domains_table->add($values);
            } catch (Database_MySQLException $e) {
                if ($e->get_error_number() == 1062) {
                    $conditions = array();
                    
                    $conditions['domain'] = $matches[1];
                    
                    $domains = $referer_domains_table->get_rows_where($conditions);
                    
                    $referer_domain_id = $domains[0]->get_id();
                } else {
                    throw $e;
                }
            }
        #} else {
        #    echo "No match!\n";
        }
        
        $values = array();
        
        $values['remote_addr'] = $remote_addr;
        $values['session_id'] = $session_id;
        $values['visited'] = $visited;
        $values['request_uri'] = $request_uri;
        $values['http_referer'] = $http_referer;
        $values['http_user_agent'] = $http_user_agent;
        $values['referer_domain_id'] = $referer_domain_id;
        
        #print_r($values);
        
        $insert_id = $this->add($values);
        
        #print "\$insert_id: $insert_id\n";
    }
    
    public function
        add_log_file($file_name)
    {
        $lines = file($file_name);
        
        foreach ($lines as $line) {
            #echo "$line\n";
            #
            
            $regex = '/^(\d+(?:\.\d+){3})\s+\S+\s+\S+\s+\[(.+)\]\s+"\w+\s+(\S+';
            
            #"
            $regex .= ')\s+\S+"\s+\d+\s+\d+\s+"(.+?)"\s+"(.+?)"/';
            
            if (
                preg_match(
                    $regex,
                    $line,
                    $matches
                )
            ) {
                #print_r($matches);
                
                #$values = array();
                #
                #$values['remote_addr'] = $matches[1];
                #$values['visited'] = date('Y-m-d H:i:s', strtotime($matches[2]));
                #$values['request_uri'] = $matches[3];
                #$values['http_referer'] = $matches[4];
                #$values['http_user_agent'] = $matches[5];
                #
                ##print_r($values);
                #
                #$last_insert_id = $this->add($values);
                
                $this->add_log_entry(
                    $matches[1],
                    '',
                    date('Y-m-d H:i:s', strtotime($matches[2])),
                    $matches[3],
                    $matches[4],
                    $matches[5]
                );
                
                #echo "\$last_insert_id: $last_insert_id\n";
            #} else {
                #echo "No match!\n";
            }
        }
    }
    
    public function
        get_entrances()
    {
        $database = $this->get_database();
        #$ignored_hosts_table = $database->get_table('ignored_hosts');
        #
        #$ignored_hosts = $ignored_hosts_table->get_all_rows();
        #
        #$ignored_hosts_where_clause = '';
        #
        #$first = TRUE;
        #foreach ($ignored_hosts as $i_h) {
        #    if ($first) {
        #        $first = FALSE;
        #    } else {
        #        $ignored_hosts_where_clause .= ' AND ';
        #    }
        #    
        #    $ignored_hosts_where_clause .= ' http_referer NOT REGEXP ';
        #    
        #    $ignored_hosts_where_clause .= ' \'^' . $i_h->get('host') . '\' ';
        #}
        
        #$ignored_hosts_where_clause
        #
        #AND
        
        $query = <<<SQL
SELECT
    hc_logging_referer_domains.domain AS domain,
    COUNT(hc_logging_server_logs.id) AS count
FROM
    hc_logging_server_logs,
    hc_logging_referer_domains
WHERE
    hc_logging_server_logs.referer_domain_id = hc_logging_referer_domains.id
GROUP BY
    hc_logging_server_logs.referer_domain_id
ORDER BY
    count DESC
SQL;
        
        #echo "\$query: $query\n";
        
        $dbh = $this->get_database_handle();
        
        $result = mysql_query($query, $dbh);
        
        $entrances = array();
        
        while ($row = mysql_fetch_array($result)) {
            $entrances[] = array(
                'domain' => $row['domain'],
                'count' => $row['count']
            );
        }
        
        return $entrances;
    }
}
?>
