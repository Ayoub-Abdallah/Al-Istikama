FROM php:8.2-apache

# Install system dependencies and PHP extensions required by Moodle
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libxml2-dev libzip-dev libicu-dev \
    libldap2-dev libonig-dev unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
       gd mysqli pdo_mysql intl soap zip opcache mbstring exif \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set Apache document root to Moodle's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Configure PHP for Moodle requirements
RUN { \
    echo "max_input_vars = 5000"; \
    echo "upload_max_filesize = 50M"; \
    echo "post_max_size = 50M"; \
    echo "memory_limit = 256M"; \
    echo "max_execution_time = 300"; \
    } > /usr/local/etc/php/conf.d/moodle.ini

# Configure OPcache for better performance on limited resources
RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.memory_consumption=128"; \
    echo "opcache.max_accelerated_files=10000"; \
    echo "opcache.revalidate_freq=60"; \
    echo "opcache.save_comments=1"; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Copy Moodle source code
COPY moodle-docker/moodle /var/www/html

# Create moodledata directory
RUN mkdir -p /var/www/moodledata \
    && chown -R www-data:www-data /var/www/moodledata \
    && chmod 775 /var/www/moodledata

# Set permissions on Moodle source
RUN chown -R www-data:www-data /var/www/html

# Render uses the PORT environment variable
# Default to 80, but allow override
ENV PORT=80
RUN sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf \
    && sed -i 's/:80/:${PORT}/g' /etc/apache2/sites-available/000-default.conf

EXPOSE ${PORT}

CMD ["apache2-foreground"]
