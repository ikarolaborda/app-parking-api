#!/bin/sh

# Create symbolic link for docs
#if [ ! -L "/var/www/appparking-api/public/docs" ]; then
#  ln -s /var/www/appparking-api/docs /var/www/appparking-api/public/docs
#fi

# Start the existing entrypoint script
exec docker-php-entrypoint php-fpm
