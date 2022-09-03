<?php
include('pass.php');
$ip = "localhost";
$porta= "22";
$user ="root";
$senha = $pass;
header('Access-Control-Allow-Origin: *');
header("Content-Type:application/json");

$link = $_GET['user'];
$connection = ssh2_connect($ip, $porta);
ssh2_auth_password($connection, $user, $senha);
$stream = ssh2_exec($connection, 'cat usuarios.db');
stream_set_blocking($stream, true);
$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
$usuarios .= stream_get_contents($stream_out);


$teste = str_replace("1", ",", $usuarios);
$teste2 = str_replace(" ", "", $teste);
#echo $teste2;

$connection = ssh2_connect($ip, $porta);
ssh2_auth_password($connection, $user, $senha);
$stream = ssh2_exec($connection, 'ps aux | grep priv | grep Ss');
stream_set_blocking($stream, true);
$stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
$usuarios2 .= stream_get_contents($stream_out);

//echo $usuarios2;



## encontrando o limite do usuario ssh
$a1  = split ($link, $usuarios);
$a2 = end($a1);
$limite = substr($a2, 1, 2); //posição inicial = 0, comprimento = 20

$up = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j","k","l","m","n","o","p","q","r","t","u","v","x","w","y","z",
"A", "b", "C", "D", "E", "F", "G", "H", "I", "J","K","L","M","N","O","P","Q","R","T","U","V","X","W","Y","Z","\n");

$acessos = str_replace($up, "", $limite);



$stream = ssh2_exec($connection, 'ps -u '.$link.' | grep -c sshd');
 stream_set_blocking($stream, true);
 $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
 $result .= stream_get_contents($stream_out);
$conexoes =str_replace("\n", "", $result);  
##Conexoes simultaneas
$shell = shell_exec('ps -u '.$link.' | grep -c sshd ');
$shellConexoes=str_replace("\n","",$shell);
#echo $shellConexoes; 

#####
$stream = ssh2_exec($connection, 'chage '.$link.' -l ');
 stream_set_blocking($stream, true);
 $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
 $result .= stream_get_contents($stream_out);

 $resultado = strstr($result, "Minimum ", true);
 $result = strstr($resultado, "Account expires");
 $string = str_replace("Account expires", "", $result); 
 $stringR = str_replace(":", "", $string); 

 $arr = explode(' ', trim($stringR));
 $result = strstr($resultado, $arr[0]);
 $mes = $arr[0];
 $mes1 = $arr[0];
		 
	 
	if($mes == "Jan"){
	 $mes = "Janeiro";
	 $numero = 1;
	}
	elseif($mes == "Feb"){
	 $mes = "Fevereiro";
	 $numero = 2;
	}
	elseif($mes == "Mar"){
	 $mes = "Março";
	 $numero = 3;
	}
	elseif($mes == "Apr"){
	 $mes = "Abril";
	 $numero = 4;
	}
	elseif($mes == "May"){
	 $mes = "Maio";
	 $numero = 5;
	}
	elseif($mes == "June"){
	 $mes = "Junho";
	 $numero = 6;
	}
	elseif($mes == "July"){
	 $mes = "Julho";
	 $numero = 7;
	}
	elseif($mes == "Aug"){
	 $mes = "Agosto";
	 $numero = 8;
	}
	elseif($mes == "Sep"){
	 $mes = "Sept";
	 $numero = 9;
	}
	elseif($mes == "Oct"){
	 $mes = "Outubro";
	 $numero = 10;
	}
	elseif($mes == "Nov"){
	 $mes = "Novembro";
	 $numero = 11;
	}
	elseif($mes == "Dec"){
	 $mes = "Dezembro";
	 $numero = 12;
	}



	$numerico = str_replace($mes1, "", $result); 

	$ano = substr($numerico, 5, 4);
	$Dia = substr($numerico, 0, 3);

	$scape = explode(' ', trim($Dia));
	$dias= $scape[0];

	$data = $ano."/".$numero."/".$dias;

	$validade = $dias."/0".$numero."/".$ano;



	$data_atual = date("Y/m/d");
	$data_validade = $data;
	if($data_validade > $data_atual){
	 $data1 = new DateTime($data_validade);
	 $data2 = new DateTime($data_atual);
	 $diasRestante = 0;
	 $diferenca = $data1->diff( $data2 );
	 $ano = $diferenca->y * 364 ;
	 $mes = $diferenca->m * 30;
	 $dia = $diferenca->d;
	 $diasRestante = $ano + $mes + $dia;

	}else{
	 $diasRestante = 0;

	}
    $conexoes = intval($conexoes);

	$oldDate = strtotime($data);

$newDate = date('d/m/Y',$oldDate);


	$arr = ['login' => $link,'acesso' => $acessos ,'validade' => $newDate, 'dias_restantes' => $diasRestante, 'online' => $conexoes ];



         // Remove chaves do array
        $data = [];
        $data[] = array_merge($data, $arr);
	 //$response = [];
	 $response = $data;
	 echo json_encode($response, JSON_PRETTY_PRINT);

###BY Apollo404

?>
