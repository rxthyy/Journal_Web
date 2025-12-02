FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html

WORKDIR /var/www/html

RUN chmod -R 775 storage bootstrap/cache

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php \
 && php composer.phar install --no-dev

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
