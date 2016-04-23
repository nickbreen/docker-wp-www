# Tags

- [`apache` (*apache/Dockerfile*)](https://github.com/nickbreen/docker-wp-cli/blob/master/apache/Dockerfile)
- [`fpm` (*fpm/Dockerfile*)](https://github.com/nickbreen/docker-wp-cli/blob/master/fpm/Dockerfile)

# This Image

Inlcudes the New Relic PHP agent.

See docker-compose.yml for an example of configuration.

## New Relic

Configure your key and application name as environment variables.

    NR_APP_NAME: "application-name"
    NR_INSTALL_KEY: "cafe..1234"

If either of the variables is an empty string the new relic agent configuration will not be installed.

## Cache Management

You should define a cron job to run `htcacheclean`, there is no job defined by default. E.g.

    environment:
      CRON_D_HTCACHECLEAN: | # Maintain a 1GB cache, run nicely, verbosely log to syslog.
        SHELL=/bin/sh
        @hourly www-data /usr/bin/htcacheclean -p /var/cache/apache2/mod_cache_disk -n -v -l 1024M | logger
