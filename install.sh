#!/usr/bin/env bash

# Created by: @Dev_apollo404

echo -e "\n\033[1;36mINSTALANDO O APACHE2 \033[1;33mAGUARDE...\033[0m"


sudo apt install apache2
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt upgrade
sudo apt install -y php5.6
sudo apt update
sudo apt install php5.6-ssh2
service apache2 restart




echo -ne "\033[1;32m INFORME A SENHA ROOT\033[1;37m: "; read senha
cd ../var/www/html
echo "<?php \$pass= '$senha'?>" > pass.php

curl -o checkuser.php 'https://raw.githubusercontent.com/wellborgmann/checkuser2/main/checkuser.php'
cd ../../../etc/apache2

curl -o ports.conf 'https://raw.githubusercontent.com/wellborgmann/checkuser2/main/ports.conf'

cd sites-available
curl -o 000-default.conf 'https://raw.githubusercontent.com/wellborgmann/checkuser2/main/000-default.conf'
sudo service apache2 restart
