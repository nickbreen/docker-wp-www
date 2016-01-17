FROM phusion/baseimage:0.9.18

MAINTAINER Nick Breen <nick@foobar.net.nz>

# Install, Apache, PHP, and New Relic support
RUN DEBIAN_FRONTEND=noninteractive \
    && echo 'deb http://apt.newrelic.com/debian/ newrelic non-free' | tee /etc/apt/sources.list.d/newrelic.list \
    && curl -sSfL https://download.newrelic.com/548C16BF.gpg | apt-key add - \
    && apt-get update -qqy \
    && apt-get install -qqy \
      apache2 \
      apache2-utils \
      libapache2-mod-php5 \
      newrelic-php5 \
      php-http \
      php5-curl \
      php5-imagick \
      php5-json \
      php5-mysql \
      php5-oauth \
    && apt-get clean -qqy

ENV NR_INSTALL_SILENT=true \
    NR_INSTALL_KEY="" \
    NR_APP_NAME=""

# Install newrelic's configuration
COPY rc.local /etc/rc.local

# Configure a service entry for Apache
RUN mkdir /etc/service/apache/
COPY run /etc/service/apache/run

# Configure and test the Apache and PHP configurations
RUN php5enmod curl imagick json mysql oauth opcache
COPY wp.conf /etc/apache2/sites-available/
RUN a2enmod dir cache_disk expires \
  && a2dissite 000-default \
  && a2ensite wp

RUN /etc/service/apache/run -t 2>&1 && /etc/service/apache/run -S
