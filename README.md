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
