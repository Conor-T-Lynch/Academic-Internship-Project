FROM php:7.4-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy existing app source code
COPY ./web /var/www/html

# Set the working directory
WORKDIR /var/www/html
 
