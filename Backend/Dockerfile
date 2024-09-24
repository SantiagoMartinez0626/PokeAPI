FROM php:8.0-cli

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
