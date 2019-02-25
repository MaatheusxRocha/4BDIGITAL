FROM ubuntu:16.04

RUN apt-get update && apt-get upgrade -y && apt-get install -y mysql-client apache2 apache2-bin libapache2-mod-php7.0 php7.0-curl php7.0-ldap php7.0-gd php7.0-mysql php7.0-mbstring php7.0-bcmath php7.0-json php7.0-snmp mcrypt php7.0-mcrypt php7.0-intl && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY arquivos-site /var/www/html
COPY brascloud.pem /etc/ssl/certs/brascloud.pem
COPY brascloud.key /etc/ssl/private/brascloud.key
COPY default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY apache2.conf /etc/apache2/apache2.conf


env APACHE_RUN_USER    www-data
env APACHE_RUN_GROUP   www-data
env APACHE_PID_FILE    /var/run/apache2.pid
env APACHE_RUN_DIR     /var/run/apache2
env APACHE_LOCK_DIR    /var/lock/apache2
env APACHE_LOG_DIR     /var/log/apache2

RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.0/apache2/php.ini
RUN a2ensite default-ssl.conf && a2ensite 000-default.conf && a2enmod ssl && a2enmod rewrite && a2enmod headers && chown -R www-data:nogroup '/var/www/' && phpenmod intl && phpenmod mcrypt && rm /var/www/html/index.html

RUN service apache2 start && service apache2 restart
# Network
EXPOSE 80 443
CMD ["apache2", "-D", "FOREGROUND"]
