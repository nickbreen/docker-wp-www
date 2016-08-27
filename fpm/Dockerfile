FROM nickbreen/wp-php:v1.3.2

MAINTAINER Nick Breen <nick@foobar.net.nz>

RUN apt-get update -y \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y php-fpm \
    && apt-get clean -y

# Configure a service entry for Apache
COPY run /etc/service/php-fpm/run

COPY www.conf /etc/php/7.0/fpm/pool.d/

# Enable for FPM
RUN phpenmod curl gd imagick json logging mysqli oauth opcache && phpdismod newrelic

ENV DOCROOT=/var/www

# Test the Configuration
RUN mkdir $DOCROOT && /etc/service/php-fpm/run -t 2>&1 && rm -rf $DOCROOT

EXPOSE 9000
