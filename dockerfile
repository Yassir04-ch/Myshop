FROM php:8.4-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    procps \
    libonig-dev \
    libpng-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory inside Laravel folder
WORKDIR /var/www/html

# Copy project
COPY . .

# Move into Laravel project (IMPORTANT for your structure)
WORKDIR /var/www/html/ecomerce

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix Apache document root
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/ecomerce/public|g' /etc/apache2/sites-available/000-default.conf

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Permissions (important)
RUN chown -R www-data:www-data /var/www/html/ecomerce/storage /var/www/html/ecomerce/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]