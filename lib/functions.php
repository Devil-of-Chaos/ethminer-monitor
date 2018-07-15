<?php

$timeout = 5;

$config_data = array();

$config_data[0]['host'] = '127.0.0.1';
$config_data[0]['port'] = '3000';

$config_data['NAME']['host'] = '127.0.0.1';
$config_data['NAME']['port'] = '3000';


$miner_id = 1;
foreach ($config_data AS $config_key => $config){
	$config['ID'] = $miner_id;

	if (isset($_GET['content'])) {
		ini_set('display_errors','0');
		error_reporting (E_ALL & ~E_NOTICE);
		session_start();
		setlocale (LC_ALL, 'en_EN');
		header('Content-Type: text/html; charset=utf-8');
		include_once('../class/helper.php');
		include_once('../class/socket.php');
		$h = new helper();
		$content = $h->input_in($_GET['content'],"url");
		$id = $h->input_in($_GET['id'],"int+");
	}
	
	include($content.'.php');
	
	$miner_id++;
}
if (isset($_GET['content'])) print json_encode($return_data);