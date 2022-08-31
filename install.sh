#!/usr/bin/env bash

# Created by: @Dev_apollo404

echo -e "\n\033[1;36m####################### \033[1;33mCRIADO POR @Dev_apollo404 \033[1;36m######################  \033[0m"
figlet -t -k -w 100 CHECKUSER APOLLO404
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
echo "<?php \$pass='$senha'?>" > pass.php
curl -o checkuser.php 'https://raw.githubusercontent.com/wellborgmann/checkuserUbuntu18/main/checkuser.php' > /dev/null 2>&1
cd ../../../etc/apache2
curl -o ports.conf 'https://raw.githubusercontent.com/wellborgmann/checkuserUbuntu18/main/ports.conf' > /dev/null 2>&1
cd sites-available
curl -o 000-default.conf 'https://raw.githubusercontent.com/wellborgmann/checkuserUbuntu18/main/000-default.conf' > /dev/null 2>&1
service apache2 restart
cd ../../../
figlet -t -k -w 100 CHECKUSER APOLLO404
echo -e "\n\033[1;36m#################### \033[1;33m CHECKUSER INSTALADO COM SUCESSO \033[1;36m###################  \033[0m"
