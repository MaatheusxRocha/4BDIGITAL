#!/bin/bash

chown -R www-data:www-data /var/www/

if [[ -f /var/www/html/.htaccess ]]
then
  chmod 755 /var/www/html/.htaccess
fi

if [[ -d /var/www/html/images ]]
then
  chmod -R 775 /var/www/html/images
fi

if [[ -d /var/www/html/archives ]]
then
 chmod -R 775 /var/www/html/archives
fi

if [[ -d /var/www/html/uploads ]]
then
chmod -R 775 /var/www/html/uploads
fi
