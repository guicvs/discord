<?php
include_once("func.php");
set_time_limit(0);

function getStr2($dado, $string, $string2){

	preg_match_all("($string(.*)$string2)siU", $dado, $match1);
	return $match1[1][0];

}

//CONSTANTES

$email = "YOUR_EMAIL";
$senha = "YOUR_PASS";
$cookienum = rand(1000000, 9999999);
$url_guilds = "https://discordapp.com/api/v6/users/@me/guilds";
$url_login = "https://discordapp.com/api/v6/auth/login";
$url_channel = "https://discordapp.com/api/v6/channels/";
$mensagem = '{"content":"TESTEEE","nonce":"","tts":false}';
$len_post = strlen($mensagem);
$login_success = false;
$request_headers = array();
$request_headers[] = "Host: discordapp.com";
$request_headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36";
$request_headers[] = "Content-Type: application/json";
$request_headers[] = "Accept: */*";
$request_headers[] = "Accept-Encoding: gzip, deflate, br";

//login
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_login);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
curl_setopt($ch, CURLOPT_ENCODING, "gzip, deflate, br");
curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/Cookies'.$cookienum.'.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/Cookies'.$cookienum.'.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"'.$email.'","password":"'.$senha.'"}');
$data = curl_exec($ch);
$token = getStr2($data, '{"token": "', '"}');
curl_close($ch);

if(strlen($token) > 0){
	array_push($request_headers, "Authorization: ".$token);
	$login_success = true;
}



//echo $token;

// ----------- ENVIARA MENSAGEM PARA TODOS OS GRUPOS

if($login_success == true){
	echo "sucesso";
}else{
	echo "VERIFIQUE OS DADOS DE EMAIL/SENHA -- CASO ESTEJAM CORRETOS VERIFIQUE SEU ENDEREÇO DE EMAIL E AUTORIZE O ENDEREÇO IP.";
}




?>