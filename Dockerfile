FROM uspdev/uspdev-php-apache:8.3

RUN sed -i 's|/var/www/html|/var/www/html/public|' \
    /etc/apache2/sites-available/000-default.conf

# Install LDAP dependencies
RUN apt-get update && \
    apt-get install -y libldap2-dev && \
    rm -rf /var/lib/apt/lists/*

# Configure and install the extension
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap    

RUN mkdir -p /var/www/.composer && chown -R www-data:www-data /var/www/.composer

USER www-data

COPY --chown=www-data . .

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

CMD ["apache2-foreground"]