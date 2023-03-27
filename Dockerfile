FROM php:8.0-apache
RUN docker-php-ext-install mysqli
WORKDIR /var/www/html
COPY . .
COPY dump.sql /docker-entrypoint-initdb.d/dump.sql
RUN a2enmod rewrite