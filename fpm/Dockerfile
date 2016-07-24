FROM nickbreen/wp-php:php

MAINTAINER Nick Breen <nick@foobar.net.nz>

RUN apt-get update -qqy \
    && DEBIAN_FRONTEND=noninteractive apt-get install -qqy \
      php5-fpm \
    && apt-get clean -qqy

# Configure a service entry for Apache
RUN mkdir /etc/service/php-fpm/
COPY run /etc/service/php-fpm/run

COPY www.conf /etc/php5/fpm/pool.d/
# Test the Configuration
RUN /etc/service/php-fpm/run -t 2>&1

EXPOSE 9000
