FROM nickbreen/cron:v2.0.0

MAINTAINER Nick Breen <nick@foobar.net.nz>

RUN echo 'deb http://apt.newrelic.com/debian/ newrelic non-free' | tee /etc/apt/sources.list.d/newrelic.list \
    && curl -sSfL https://download.newrelic.com/548C16BF.gpg | apt-key add - \
    && apt-get update -y \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y \
      newrelic-php5 \
      php-http \
      php-curl \
      php-imagick \
      php-fpm \
      php-gd \
      php-json \
      php-mysql \
      php-oauth \
    && apt-get clean -y

ENV NR_INSTALL_KEY="" NR_APP_NAME=""

# Configure and test the PHP configurations
RUN phpenmod curl gd imagick json mysqli oauth opcache

# Configure a service entry for Apache
RUN mkdir /etc/service/php-fpm/
COPY run /etc/service/php-fpm/run

COPY www.conf /etc/php/7.0/fpm/pool.d/

# Test the Configuration
RUN mkdir -p /var/www && /etc/service/php-fpm/run -t 2>&1 && rm -rf /var/www

EXPOSE 9000

ENV DOCROOT=/var/www
