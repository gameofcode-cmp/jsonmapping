FROM php:8.1-apache

# Install dependencies
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
  libssl-dev \
  zlib1g-dev \
  libzip-dev \
  libicu-dev \
  g++ \
  git \
  unzip \
  && pecl install mongodb \
  && docker-php-ext-enable mongodb \
  && docker-php-ext-install zip intl

# Configure Apache
#COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf
#RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy app
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Install app dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Set the working directory
WORKDIR /var/www/html
