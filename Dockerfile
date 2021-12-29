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

# Ejecutar 1 ves para crear las migraciones y los seeaders, si lo ejecutas 2 veces vas a borrar tu base de datos por una nueva
#CMD php artisan migrate:fresh && php artisan db:seed && php artisan serve --host=0.0.0.0 --port=8000

#ejecutar cada ves que se vaya a reiniciar/iniciar el server, cuando ya EXISTA la db
CMD php artisan serve --host=0.0.0.0 --port=8000


