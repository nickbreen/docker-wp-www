# This Image

Inlcudes the New Relic PHP agent.

See docker-compose.yml for an example of configuration.

Use either FPM or Apache.

## New Relic

Configure your key and application name as environment variables.

    NR_APP_NAME: "application-name"
    NR_INSTALL_KEY: "cafe..1234"

If either of the variables is an empty string the new relic agent configuration will not be installed.

# Apache

Apache is configured with `mod_cache` with both `mod_cache_disk` and `mod_cache_socache` with `socache_memcache`.

## Cache Management

You should define a cron job to run `htcacheclean`, there is no job defined by default. E.g.

    environment:
      CRON_D_HTCACHECLEAN: | # Maintain a 1GB cache, run nicely, verbosely log to syslog.
        SHELL=/bin/sh
        @hourly www-data /usr/bin/htcacheclean -p /var/cache/apache2/mod_cache_disk -n -v -l 1024M | logger

If you have a very large disk cache you may want to break up `htcacheclean` into finder grained invokations, you may also need to increase the time between invokations.

    environment:
      CRON_D_HTCACHECLEAN: | # Maintain a 4GB cache, run nicely, verbosely log to syslog.
        SHELL=/bin/sh
        # There are 4K cache directories with the default configuration. A 4G cached requires a 1M directory. 
        @hourly www-data find /var/cache/apache2/mod_cache_disk -maxdepth 2 -mindepth 2 -type d | xargs -r -l -t htcacheclean -v -n -t -l 1M -p | logger

