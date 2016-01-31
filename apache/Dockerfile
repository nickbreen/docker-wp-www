FROM phusion/baseimage:0.9.18

MAINTAINER Nick Breen <nick@foobar.net.nz>

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

ENV NR_INSTALL_KEY="" NR_APP_NAME=""

# Configure a service entry for Apache
RUN mkdir /etc/service/apache/
COPY run /etc/service/apache/run

# Enable the cron based htcache cleanup
RUN sed -i /HTCACHECLEAN_MODE/s/daemon/cron/ /etc/default/apache2

# Configure and test the Apache and PHP configurations
RUN php5enmod curl imagick json mysql oauth opcache
#COPY default.conf /etc/apache2/sites-available/000-default.conf
COPY proxy.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod cache_disk dir expires headers setenvif proxy_http\
  && a2dismod autoindex

COPY tweaks.ini /etc/php5/mods-available/
RUN php5enmod tweaks
RUN /etc/service/apache/run -t 2>&1

EXPOSE 80
