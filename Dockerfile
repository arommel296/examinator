FROM php:7.4-apache
RUN apt-get update -y && docker-php-ext-install -y pdo pdo_mysql
WORKDIR /var/www/html
COPY . .