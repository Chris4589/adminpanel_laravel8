FROM php

RUN docker-php-ext-install pdo pdo_mysql sockets
RUN apt-get update && apt-get install -y curl unzip 


RUN curl -sS https://getcomposer.org/installer​ | php -- \
    --install-dir=/usr/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
RUN composer install

EXPOSE 8000

CMD php artisan migrate:fresh && php artisan db:seed && php artisan serve --host=0.0.0.0 --port=8000


