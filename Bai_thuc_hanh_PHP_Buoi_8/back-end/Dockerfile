FROM php:8.2-cli-alpine

RUN docker-php-ext-install pdo_mysql

# Nâng giới hạn của PHP lên trên 2 MB để chính API kiểm tra dung lượng và trả thông báo lỗi rõ ràng
RUN printf "upload_max_filesize=10M\npost_max_size=12M\n" > /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www/html

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
