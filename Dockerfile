FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install \
    zip \
    intl \
    pdo_mysql

# Set working directory
WORKDIR /app

# Copy project
COPY . .

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port
EXPOSE 8000

# Start Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
