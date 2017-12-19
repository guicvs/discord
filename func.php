<?php
//SCRIPT FEITO NO PHP 7.1;
//ERROS IRÃO OCORRER CASO USE PHP INFERIOR À 7;
//error_reporting(0);
set_time_limit(0);
class discord{
	
	public $cookienum;
	public $email;
	public $senha;
	public $token;
	public $guilds_count;
	public $login_success;
	public $login_error_msg;
	public $guild_master;
	//public $request_headers = Array();
	
    public function __construct($email, $senha) {
         $this->cookienum = rand(1000, 9999);
		 $this->email = $email;
		 $this->senha = $senha;
		 $this->token = null;
    }
	
	public function getStr2($dado, $string, $string2){

		preg_match_all("($string(.*)$string2)siU", $dado, $match1);
		return $match1[1][0];

	}
	
	public function login(array $request_headers){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/auth/login");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip, deflate, br");
		curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/Cookies'.$this->cookienum.'.txt');
		curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/Cookies'.$this->cookienum.'.txt');
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"'.$this->email.'","password":"'.$this->senha.'"}');
		$data = curl_exec($ch);
		if(strpos($data, "New login location detected, please check your e-mail.") !== false){
			$this->login_success = "false";
			$this->login_error_msg = $data;
			$this->token = "false";
			return "NOVA LOCALIZAÇÃO DE IP DETECTADA, POR FAVOR, VERIFUQE SEU E-MAIL";
		}elseif(strpos($data, '"token":') !== false){
			$this->token = $this->getStr2($data, '{"token": "', '"}');
			$this->login_success = "true";
			$this->login_error_msg = "none";
			//return $this->token;
		}else{
			$this->token = "false";
			$this->login_success = "false";
			$this->login_error_msg = $data;
		}
	}
	
	public function guilds(array $request_headers){
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/users/@me/guilds");
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
		$data = curl_exec($ch);
		$this->guilds_count = count(json_decode($data));
		
		if($this->guilds_count < 2){
			$this->guilds_count = "false";
		}else{
			$this->guild_master = $data;
		}
		
	}
	
	public function spam(array $request_headers){
		
		function makemagic($id, $cookienum, $request_headers){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://discordapp.com/api/v6/channels/".$id."/messages");
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
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{"content":"teste","nonce":false,"tts":false}');
			$data = curl_exec($ch);
		}
		$i = 0;
		while($i < $this->guilds_count){
			flush();
			ob_flush();
			 $name = json_decode($this->guild_master, true)[$i]["name"];
			 $id = json_decode($this->guild_master, true)[$i]["id"];
			 $icon = json_decode($this->guild_master, true)[$i]["icon"];
			 $dono = json_decode($this->guild_master, true)[$i]["owner"];
			 
			makemagic($id, $this->cookienum, $request_headers);
			sleep(5);
			$i++;
		}
	}
	
	public function debug2(){
		for ($i=0; $i < $this->guilds_count; $i++) {
			$name = json_decode($this->guild_master, true)[$i]["name"];
			$id = json_decode($this->guild_master, true)[$i]["id"];
			$icon = json_decode($this->guild_master, true)[$i]["icon"];
			$dono = json_decode($this->guild_master, true)[$i]["owner"];
			if(strlen($dono) > 0){
				$dono = "SIM";
			}else{
				$dono = "NAO";
			}
			if(strlen($icon) > 0){
				
			}else{
				$icon = "NAO CONTEM";
			}
			echo "- GRUPO: $name| ID: $id| ICONE: $icon| DONO: $dono \r\n";
		}
	}
	
	public function debug(){
		
		unlink(getcwd().'\Cookies'.$this->cookienum.'.txt');
		return array(rand_cookie => $this->cookienum, email => $this->email, senha => $this->senha, success_login => $this->login_success, login_error_msg => $this->login_error_msg, token => $this->token, guilds => $this->guilds_count);
	}
	
}

?>
