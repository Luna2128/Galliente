FROM tiangolo/nginx-rtmp:latest

# Instalar dependencias y PHP
RUN apt-get update && \
    apt-get install -y ffmpeg \
    php-fpm \
    php-mbstring \
    php-xml \
    php-mysql && \
    apt-get clean

# Configurar PHP-FPM
RUN echo "cgi.fix_pathinfo=0" >> /etc/php/7.4/fpm/php.ini
RUN echo "display_errors = On" >> /etc/php/7.4/fpm/php.ini

# Configuramos el directorio de trabajo
WORKDIR /var/www/html

# Exponer los puertos
EXPOSE 1935 80

# Iniciar NGINX y PHP-FPM
CMD service php7.4-fpm start && nginx -g 'daemon off;'
