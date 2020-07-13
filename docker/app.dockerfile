FROM php:7.4-fpm
RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo_mysql \
    && pecl install xdebug-2.9.6 \
    && docker-php-ext-enable xdebug

CMD ["php-fpm"]
