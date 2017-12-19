<?php
include_once("func.php");
$classe = new discord("YOUR_EMAIL", "YOUR_PASS"); //ENVIA OS PARAMETROS DE LOGIN E CHAMA A CLASSE discord

$request_headers = array();
$request_headers[] = "Host: discordapp.com";
$request_headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36";
$request_headers[] = "Content-Type: application/json";
$request_headers[] = "Accept: */*";
$request_headers[] = "Accept-Encoding: gzip, deflate, br";

//$classe->login($request_headers); EFETUA LOGIN

//array_push($request_headers, "Authorization: ".$classe->token); ATIVE PARA USAR A GUILDS $classe->guilds

//$classe->guilds($request_headers); //ACESSA A ÁREA DE GUILDS COM O TOKEN

//print_r($classe->debug()); // MOSTRA INFORMAÇOES DE ACESSO

// ------------------ PARA TODOS OS GRUPOS SPAMMAR

//array_push($request_headers, "Content-Length: 45");

//$classe->spam($request_headers);

//  ------------------ FIM PARA TODOS OS GRUPOS SPAMMAR

//$classe->debug2(); //MOSTRA INFORMAÇOES SOBRE OS GUILDS DA SUA CONTA (GRUPOS)


?>

