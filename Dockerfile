FROM php:7.4-apache

ENV DB_DATABASE=set-me
ENV DB_HOST=set-me
ENV DB_PASSWORD=set-me
ENV DB_USER=set-me
ENV ENABLE_SSL=false
ENV PORT=9000
ENV SETUP_FREE_ACCESS=false

# Configure Apache
RUN cp /etc/apache2/mods-available/headers.load /etc/apache2/mods-enabled
RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Install required PHP plugins
RUN docker-php-ext-install mysqli

COPY . /var/www/html/
RUN mv /var/www/html/docker/* /usr/local/bin/ && \
    rm -rf /var/www/html/docker && \
    mkdir -p /var/www/html/classes/htmlpurifier/standalone/HTMLPurifier/DefinitionCache/Serializer && \
    chmod 777 /var/www/html/classes/htmlpurifier/standalone/HTMLPurifier/DefinitionCache/Serializer

CMD ["bcoem-entry"]
