<?php
if ($config['ID'] == $id){
	$miner = new socket($config['host'], $config['port'], $timeout);
	$ping_msg = $miner->returnArray('miner_ping');
	if (isset($ping_msg['result']) && $ping_msg['result'] == 'pong'){
		if (isset($_GET['gpuID'])) $gpuID = $h->input_in($_GET['gpuID'],"int+");
		if (isset($_GET['toggle'])) $toggle = $h->input_in($_GET['toggle'],"string");
		if ($toggle == 'deactivate') $pause = true;
		else $pause = false;
		$miner_data = $miner->returnArray('miner_pausegpu', array('index' => $gpuID, 'pause' => $pause));
		if (is_array($miner_data['result'])){
			$return_data = $miner_data['result'];
		}
	}
}
