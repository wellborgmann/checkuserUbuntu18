#!/usr/bin/env bash

# Created by: @Dev_apollo404

sudo apt-get remove --purge apache2 apache2-utils


echo -e "\n\033[1;36mINSTALANDO O APACHE2 \033[1;33mAGUARDE...\033[0m"
apt-get install apache2 -y > /dev/null 2>&1
sudo add-apt-repository ppa:ondrej/php
service apache2 restart > /dev/null 2>&1

sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt upgrade
sudo apt install -y php5.6
sudo apt update
sudo apt install php5.6-ssh2

sudo service apache2 restart

echo -ne "\033[1;32m INFORME A SENHA ROOT\033[1;37m: "; read senha
cd ../var/www/html
echo "<?php \$pass= '$senha'?>" > pass.php

curl -o online.php 'https://raw.githubusercontent.com/wellborgmann/checkuser2/main/online.php'
cd ../../../etc/apache2

curl -o ports.conf 'https://raw.githubusercontent.com/wellborgmann/checkuser2/main/ports.conf'

cd sites-available
curl -o 000-default.conf 'https://raw.githubusercontent.com/wellborgmann/checkuser2/main/000-default.conf'
sudo service apache2 restart
