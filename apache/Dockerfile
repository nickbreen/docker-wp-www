FROM nickbreen/wp-php:v1.2.0

MAINTAINER Nick Breen <nick@foobar.net.nz>

RUN apt-get update -qqy \
    && DEBIAN_FRONTEND=noninteractive apt-get install -qqy \
      apache2 \
      apache2-utils \
      libapache2-mod-php5 \
    && apt-get clean -qqy

# Configure a service entry for Apache
RUN mkdir /etc/service/apache/
COPY run /etc/service/apache/run

# Enable the cron based htcache cleanup
RUN sed -i /HTCACHECLEAN_MODE/s/daemon/cron/ /etc/default/apache2

# Configure Apache
RUN a2enmod cache_disk dir expires headers setenvif proxy_http && a2dismod autoindex

COPY log.conf /etc/apache2/conf-available/log.conf
COPY proxy.conf /etc/apache2/sites-available/001-proxy.conf
COPY cache.conf /etc/apache2/sites-available/002-cache.conf

RUN a2enconf log && a2ensite 001-proxy 002-cache && a2dissite 000-default

RUN /etc/service/apache/run -t 2>&1

# Define the cache dir as a volume
VOLUME /var/cache/apache2/mod_cache_disk

EXPOSE 80
