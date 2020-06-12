FROM composer:latest as build

# Install composer
WORKDIR /var/www/html/project

# Install Composer
# RUN curl -sS https://getcomposer.org/installer | php && \
#     mv composer.phar /usr/local/bin/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html/project
# RUN composer install --no-scripts --no-autoloader --ignore-platform-reqs && \
#    composer dump-autoload --optimize

FROM gitlab.vascomm.co.id:4567/frontend-docker-image/php-7:latest

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory permissions
# COPY . /var/www/html
COPY --from=build --chown=root:root /var/www/html/project /var/www/html

RUN chmod +x /var/www/html/nginx-conf/script.sh

# Expose port 9000 and start php-fpm server
ENTRYPOINT ["sh", "/var/www/html/nginx-conf/script.sh"]
