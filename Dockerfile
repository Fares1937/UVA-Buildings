# Use the official PHP 7.4 Apache image from Docker Hub
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the contents of your local directory into the working directory
COPY . .

# Install libzip-dev and configure the zip extension
RUN apt-get update \
    && apt-get install -y libzip-dev zlib1g-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# Enable Apache modules and restart Apache
RUN a2enmod rewrite \
    && service apache2 restart

# Expose port 80 for web traffic
EXPOSE 80

# Define an entry point, e.g., to start your PHP application
CMD ["php", "index.php"]

# You can uncomment the CMD line above and specify the command to run your PHP application.
# Replace "index.php" with the actual entry point of your application.
