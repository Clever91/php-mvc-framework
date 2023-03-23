FROM php:8.1-apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN apt-get update && \
    apt-get install \
    libzip-dev \
    wget \
    git \
    unzip \
    -y --no-install-recommends
RUN docker-php-ext-install zip pdo_mysql
COPY ./install-composer.sh ./
COPY ./php.ini /usr/local/etc/php/
RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh ./install-composer.sh \
    && rm ./install-composer.sh
WORKDIR /var/www
# COPY ../ .
RUN chown -R www-data:www-data /var/www
CMD [ "apache2-foreground" ]