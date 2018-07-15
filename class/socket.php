<?php
class socket {
	
	private $host = '127.0.0.1';
	private $port = 3333;
	private $timeout = 5;
	private $auth = false;
	protected $socket;
	
	public function __construct($host = '', $port = '', $timeout = '') {
		if ($host) $this->host = $host;
		if ($port) $this->port = $port;
		if ($timeout) $this->timeout = $timeout;
	}
	
	public function returnArray($message, $params = NULL, $pass = NULL){
		return json_decode($this->send($message, $params, $pass), true);
	}
	
	public function send($message, $params = NULL, $pass = NULL) {
		if (!isset($this->socket)) {
			$this->socket = @fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
			if ($this->socket === false) {
				return $this->error("Connection to ".$this->host.":".$this->port." failed");
			}
			stream_set_timeout($this->socket, $this->timeout);
		}
		if (isset($pass) && $pass){
			fwrite($this->socket, $this->message("api_authorize", array("psw" => $pass)));
			fwrite($this->socket, "\n");
			fflush($this->socket);
			$auth = fgets($this->socket);
			if ($auth === false){
				return $this->error("Authentication failed");
			}
			$auth = json_decode($auth, true);
			if ($auth['result'] == true){
				fwrite($this->socket, $this->message($message, $params));
				fwrite($this->socket, "\n");
				fflush($this->socket);
			} else {
				return $this->error("Authentication failed");
			}
		} else {
			fwrite($this->socket, $this->message($message, $params));
			fwrite($this->socket, "\n");
			fflush($this->socket);
		}
		$response = fgets($this->socket);
    if ($response === false) {
			return $this->error("Connection to ".$this->host.":".$this->port." failed. No Data returned");
    }
    return $response;
	}
	
	private function message($message, $params) {
		$return = array(
			"id"				=>	1,
			"jsonrpc"		=>	"2.0",
			"method"		=>	$message
		);
		if (is_array($params)){
			$return['params'] = $params;
		}
		return json_encode($return);
	}
	
	private function error($error=''){
		return '{"error":"true","message":"'.$error.'"}';
	}
	
	public function __destruct() {
		if ($this->socket) {
			fclose($this->socket);
		}
	}
}
?>