#!/usr/bin/env bash
echo "cd /vagrant" >> /home/vagrant/.bashrc
echo "deb http://packages.dotdeb.org jessie all" > /etc/apt/sources.list.d/dotdeb.list
wget -O- https://www.dotdeb.org/dotdeb.gpg | apt-key add -
apt update
apt-get install -y php7.0

php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
php composer-setup.php --filename=composer --install-dir=/bin
php -r "unlink('composer-setup.php');"

composer install