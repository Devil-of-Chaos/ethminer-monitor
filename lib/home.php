<?php
$miner = new socket($config['host'], $config['port'], $timeout);
$ping_msg = $miner->returnArray('miner_ping');
if (isset($ping_msg['result']) && $ping_msg['result'] == 'pong'){
	$return_data[$config_key]['ONLINE'] = true;
	$miner_data = $miner->returnArray('miner_getstat1');
	if (is_array($miner_data['result'])){
		$mining_stats = explode(';', $miner_data['result'][2]);
		$return_data[$config_key]['STATS']['VERSION'] = $miner_data['result'][0];
		$return_data[$config_key]['STATS']['UPTIME'] = $h->formatTime($miner_data['result'][1]);
		$return_data[$config_key]['STATS']['HASHRATE'] = $h->formatHashrate($mining_stats[0]);
	} else {
		$return_data[$config_key]['ONLINE'] = false;
	}
} else {
	$return_data[$config_key]['ONLINE'] = false;
}

if (is_string($config_key)){
	$return_data[$config_key]['MINER'] = $config_key;
} else {
	$return_data[$config_key]['MINER'] = $config['host'];
}

$return_data[$config_key]['ID'] = $config['ID'];