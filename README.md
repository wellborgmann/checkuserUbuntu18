__Script__404__

INSTALAÇÃO
 
 [ Ubuntu 18 ou 20 ]
 
 1º Desative a porta 80 caso esteja ativada, você poderá abrir novamente após a instalação!
 
 2º Verifique a versão do PHP com o comando "php -v", a versão do php deve ser 5.6, se caso não estiver instalado, ótimo o script irá instalar a versão correta.
 
 OBS: Em caso de erro na instalação ou não funcionar, formate a VPS, instale o gerenciador ssh e em seguida o script que ocorrerá bem! 
 
- Seu link ficará assim:

Dominio-ou-ip:8081/checkuser.php?user=
 
 
 
curl -sL https://raw.githubusercontent.com/wellborgmann/checkuserUbuntu18/main/install.sh > install.sh; chmod +x install.sh; ./install.sh
