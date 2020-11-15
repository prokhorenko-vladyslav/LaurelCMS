FROM php:7.4-fpm

RUN apt-get update

RUN apt-get install -y --no-install-recommends \
    bash \
    nano \
    supervisor

# Install extensions
RUN docker-php-ext-install pdo_mysql exif pcntl

COPY supervisord/supervisord.conf /etc/supervisor/

COPY supervisord/conf.d/app.conf /etc/supervisor/conf.d/

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
