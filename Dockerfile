FROM php:7.2-apache

RUN apt-get update
RUN apt-get install -y zip
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

ADD ./ /var/www/html
WORKDIR /var/www/html

RUN composer update

EXPOSE 80
CMD ["apache2-foreground"]
