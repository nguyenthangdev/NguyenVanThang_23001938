FROM php:8.2-cli-alpine

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html

COPY app/ /var/www/html/

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
