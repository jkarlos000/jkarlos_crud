FROM php:7.3-apache

ARG XDEBUG_DEFAULT_ENABLE
ARG XDEBUG_REMOTE_AUTOSTART
ARG REMOTE_PORT
ARG XDEBUG_IDE_KEY
ARG XDEBUG_LOCAL_HOST_IP
ARG XDEBUG_CLI_COLOR

ENV APP_HOME /var/www/html

  # Install all the dependencies and enable PHP modules
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
fish \
procps \
nano \
git \
unzip \
libicu-dev \
zlib1g-dev \
libxml2 \
libxml2-dev \
libreadline-dev \
supervisor \
cron \
libzip-dev \
librabbitmq-dev \
&& pecl install amqp \
&& docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
&& docker-php-ext-install \
pdo_mysql \
sockets \
intl \
zip \
&& docker-php-ext-enable amqp && \
rm -fr /tmp/* && \
rm -rf /var/list/apt/* && \
rm -r /var/lib/apt/lists/* && \
apt-get clean

RUN apt-get install -y \
&& docker-php-source extract \
&& pecl install xdebug redis \
&& docker-php-ext-enable xdebug redis \
&& docker-php-source delete \
&& echo "xdebug.remote_enable=${XDEBUG_DEFAULT_ENABLE}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_autostart=${XDEBUG_REMOTE_AUTOSTART}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_port=${REMOTE_PORT}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.idekey=${XDEBUG_IDE_KEY}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.remote_host=${XDEBUG_LOCAL_HOST_IP}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
&& echo "xdebug.cli_color=${XDEBUG_CLI_COLOR}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

  # Disable default site and delete all default files inside APP_HOME
RUN a2dissite 000-default.conf
RUN rm -r $APP_HOME

  # change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN chown -R www-data:www-data $APP_HOME

  # put apache and php config for Symfony, enable sites
COPY ./.docker/hosts/symfony.conf /etc/apache2/sites-available/symfony.conf
COPY ./.docker/hosts/symfony-ssl.conf /etc/apache2/sites-available/symfony-ssl.conf
RUN a2ensite symfony.conf && a2ensite symfony-ssl
COPY ./.docker/php/php.ini /usr/local/etc/php/php.ini

  # enable apache modules
RUN a2enmod rewrite
RUN a2enmod ssl

  # install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

  # generate certificates
  # TODO: change it and make additional logic for production environment
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/ssl-cert-snakeoil.key -out /etc/ssl/certs/ssl-cert-snakeoil.pem -subj "/C=AT/ST=Vienna/L=Vienna/O=Security/OU=Development/CN=example.com"

  # set working directory
WORKDIR $APP_HOME

  # create composer folder for user www-data
RUN mkdir -p /var/www/.composer && chown -R www-data:www-data /var/www/.composer

USER www-data

  # copy source files
COPY --chown=www-data:www-data . $APP_HOME/

USER root
