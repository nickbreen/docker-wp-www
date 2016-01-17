FROM phusion/baseimage:0.9.18

MAINTAINER Nick Breen <nick@foobar.net.nz>

RUN DEBIAN_FRONTEND=noninteractive \
    && echo 'deb http://apt.newrelic.com/debian/ newrelic non-free' | tee /etc/apt/sources.list.d/newrelic.list \
    && curl -sSfL https://download.newrelic.com/548C16BF.gpg | apt-key add - \
    && apt-get update -qqy \
    && apt-get install -qqy \
      newrelic-php5 \
      php-http \
      php5-fpm \
      php5-curl \
      php5-imagick \
      php5-json \
      php5-mysql \
      php5-oauth \
    && apt-get clean -qqy

ENV NR_INSTALL_KEY="" NR_APP_NAME=""

# Configure a service entry for Apache
RUN mkdir /etc/service/php-fpm/
COPY run /etc/service/php-fpm/run

# Configure and test the PHP configurations
RUN php5enmod curl imagick json mysql oauth opcache

COPY tweaks.ini /etc/php5/mods-available/
COPY www.conf /etc/php5/fpm/pool.d/
RUN php5enmod tweaks
# Test the Configuration
RUN /etc/service/php-fpm/run -t 2>&1

EXPOSE 9000
