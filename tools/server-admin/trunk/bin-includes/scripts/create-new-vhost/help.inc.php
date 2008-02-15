The create-new-vhost script.
© Clear Line Web Design, 2007-09-13

Args:

    --directory=<DIRECTORY>
        The directory where the files are stored.
    --server-name=<SEVER_NAME>
        The name of the server.
    --ip-address=<IP_ADDRESS>
        Default: *
    --port=<PORT>
        Default: 80
    --document-root
        Default: <DIRECTORY>/public_html
    --logs-dir
        Default: <DIRECTORY>/logs
    --name-virtual-host
        Whether to create a name virtual host directive or not.
    --ssl
        Whether this should require SSL or not by redirecting.
    --ssl-port
        Default: 443
    --listen-ssl-port
        Whether there should be a directive to listen to the SSL port or not.
        If the SSL port is set to the default value,
        then this defaults to false.
        If the SSL port is set to some other value,
        then this defaults to true.
    --ssl-name-virtual-host
        Whether the SSL vhost needs a NameVitualHost directive or not.
        Default: true.
    --ssl-cert-dir
        Default: /etc/apache2/ssl
    --password-protect
        Whether to password protect the directory or not.
        If the vhost requires SSL, only the SSL vhost is password
        protected.
    --password-protect-group
        The group allowed to see the vhost if password protected.
