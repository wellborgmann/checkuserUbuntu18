
<!DOCTYPE html>
<html class="loading bordered-layout" lang="pt-br" data-layout="bordered-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');


$ip = "localhost";
$porta= "22";
$user ="root";
$senha = "34QN2gmGbQOBC";
     


$result = "";
	
$link = $_GET['user'];
	




 //Realiza a comunicacao com o servidor

 $connection = ssh2_connect($ip, $porta);
 ssh2_auth_password($connection, $user, $senha);
 $stream = ssh2_exec($connection, 'chage '.$link.' -l ');
 stream_set_blocking($stream, true);
 $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
 $result .= stream_get_contents($stream_out);
 echo $result."<br>";
 $resultado = strstr($result, "Minimum ", true);

 $result = strstr($resultado, "Account expires");
 
 $string = str_replace("Account expires", "", $result); 
 $stringR = str_replace(":", "", $string); 
 
 
			 
			 //echo $stringR;
 
			 $arr = explode(' ', trim($stringR));
			 $result = strstr($resultado, $arr[0]);
		  
 
 $mes = $arr[0];
 $mes1 = $arr[0];
 
			 // grep -c sshd
		 
	 
				 if($mes == "Jar"){
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
				 //echo $Dia."/";
				 //echo $numero."/";
				 
				 //echo $ano;
				 $scape = explode(' ', trim($Dia));
				  $dias= $scape[0];
 
				 $data = $ano."/".$numero."/".$dias;
 
				 $validade = $dias."/".$numero."/".$ano;
				 
		 
				 //echo "<br>";
 
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
					 //echo $diasRestante;
					 
		 
				 }else{
					 $diasRestante = 0;
					 //echo $diasRestante;
				 }
			 
 
				 $arr = ['validade' => $validade, 'dias_restantes' => $diasRestante, 'Login' => $link,'online' => "1" ,'acesso' => "1" ];
 
		 // Remove chaves do array
		 $data = [];
		 $data[] = array_merge($data, $arr);
 
	 //$response = [];
	 $response = $data;
 
	 echo json_encode($response, JSON_PRETTY_PRINT);



?>